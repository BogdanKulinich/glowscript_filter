# glowscript_filter
<h2>How to use:</h2>
Place you GlowScript code between [GS and GS].

<h2> Example: </h2>
<pre>
<code> 
[GS
  var scene = canvas();
  var b = box();
  function spin() {
    b.rotate({angle: 0.01, axis: vec(0, 1, 0)});
    rate(100, spin); 
  }
  spin();
GS]
</code>
</pre>
