<?php

class WikiExtension extends \Twig\Extension\AbstractExtension {
	public function getFunctions() {
		global $profiler;

		return [
			new \Twig\TwigFunction('userlink', 'userlink', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('custom_info', 'customInfo', ['is_safe' => ['html']]),
			new \Twig\TwigFunction('git_commit', 'gitCommit'),
			new \Twig\TwigFunction('profiler_stats', function () use ($profiler) {
				$profiler->getStats();
			}),
			new \Twig\TwigFunction('custom_header', 'customHeader'),

		];
	}
	public function getFilters() {
		return [

			// Markdown function for non-inline text, sanitized.
			new \Twig\TwigFilter('markdown', function ($text) {
				$markdown = new Parsedown();
				$markdown->setSafeMode(true);
				return $markdown->text($text);
			}, ['is_safe' => ['html']]),

			// Markdown function for inline text, sanitized.
			new \Twig\TwigFilter('markdown_inline', function ($text) {
				$markdown = new Parsedown();
				$markdown->setSafeMode(true);
				return $markdown->line($text);
			}, ['is_safe' => ['html']]),

			// Markdown function for non-inline text. **NOT SANITIZED, DON'T LET IT EVER TOUCH USER INPUT**
			new \Twig\TwigFilter('markdown_unsafe', function ($text) {
				$markdown = new Parsedown();
				return $markdown->text($text);
			}, ['is_safe' => ['html']]),

			// Markdown function for wiki, sanitized and using the ToC extension.
			new \Twig\TwigFilter('markdown_wiki', 'parsing', ['is_safe' => ['html']]),

			new \Twig\TwigFilter('number_format', 'number_format')

		];
	}
}
