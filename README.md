# filter_glowscript
<p>Use simple insert syntaxis to add GlowScript visualizations to your Moodle content by using of any available languages.</p>

<h2>Available languages:</h2>
<ol>
    <li>VPython</li>
    <li>JavaScript</li>
    <li>RapydScript</li>
    <li>CoffeeScript</li>
</ol>

<h2>Syntaxis:</h2>
<b>Important:</b><i> if you are using editor to create Moodle content, select HTML mode to insert code correctly</i>
<pre>
<code>
    [GS // open insert marker
    GlowScript {ver} {lang} // Header config
    ...CODE...
    GS] // close insert marker
</code>
</pre>
<article>
    <p> "[GS" is an open and "GS]" is a close insert markers</p>
    <p> {ver} - is a version of GlowScript, for example: 2.3</p>
    <p> {lang} - is a language you will use</p>
</article>

<h2> Example: </h2>
<pre>
<code> 
[GS
GlowScript 2.3 RapydScript
# Binary star

def display_instructions():
    s = "In GlowScript programs:\n\n"
    s += "    Rotate the camera by dragging with the right mouse button,\n        or hold down the Ctrl key and drag.\n\n"
    s += "    To zoom, drag with the left+right mouse buttons,\n         or hold down the Alt/Option key and drag,\n         or use the mouse wheel.\n"
    s += "\nTouch screen: pinch/extend to zoom, swipe or two-finger rotate."
    scene.caption = s

# Display text below the 3D graphics:
scene.title = "Binary Star"
display_instructions()
scene.forward = vec(0,-.3,-1)

G = 6.7e-11
trails = []

giant = sphere( pos=vec(-1e11,0,0), size=4e10*vec(1,1,1), color=color.red )
giant.mass = 2e30
giant.p = vec(0, 0, -1e4) * giant.mass
trails.append(attach_trail(giant, retain=50))

dwarf = sphere( pos=vec(1.5e11,0,0), size=2e10*vec(1,1,1), color=color.yellow )
dwarf.mass = 1e30
dwarf.p = -giant.p

stars = [giant, dwarf]
trails.append(attach_trail(dwarf, type="spheres", pps=20, retain=20))

dt = 1e5
while True:
    rate(200,wait)

    dist = dwarf.pos - giant.pos
    force = G * giant.mass * dwarf.mass * dist / mag(dist)**3
    giant.p = giant.p + force*dt
    dwarf.p = dwarf.p - force*dt
    giant.pos = giant.pos + (giant.p/giant.mass) * dt
    dwarf.pos = dwarf.pos + (dwarf.p/dwarf.mass) * dt
GS]
</code>
</pre>
