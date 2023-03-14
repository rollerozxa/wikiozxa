<?php

class Cache {
	public $enabled = false;
	private $memcached;
	private $pre;

	function __construct($memcachedServers, $memcachedPrefix) {
		if (!empty($memcachedServers)) {
			$this->enabled = true;
			$this->memcached = new Memcached();
			$this->memcached->addServers($memcachedServers);
			$this->pre = $memcachedPrefix;
		}
	}

	public function hit($key, $uncachedContent, $expire = 0) {
		if ($this->enabled)
			return $this->hitMem($key, $uncachedContent, false, $expire);
		else
			return $uncachedContent();
	}

	private function hitMem($key, $uncachedContent, $expire = 0) {
		$cached = $this->get($key);
		if ($cached !== false)
			return $cached;
		else {
			$content = $uncachedContent();
			$this->set($key, $content, $expire);
			return $content;
		}
	}

	// Low-level wrapper functions
	public function get($key) {
		if ($this->enabled)
			return $this->memcached->get($this->pre.$key);
	}

	public function set($key, $value, $expiration = 0) {
		if ($this->enabled)
			return $this->memcached->set($this->pre.$key, $value, $expiration);
	}

	public function delete($key) {
		if ($this->enabled)
			return $this->memcached->delete($this->pre.$key);
	}
}

$cache = new Cache($memcachedServers, $memcachedPrefix);
