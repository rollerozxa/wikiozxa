local l, json, data = ...

l.write('<a href="https://%s"><img class="thumb" alt="%s" title="%s" src="https://%s"></a>',
	data.src, data.alt, data.alt, data.src)

l.output()
