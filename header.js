w = window.innerWidth
h = window.innerHeight

if (h <= w){
    a = h - 200
}else{
    a = w - 200
}

document.write("<a href='/'><svg height='100' width='300'><image x='0' y='0' height='100' xlink:href='./photos/logo_vf_fond_transparent.svg'/></svg></a>")
// document.write("<a href='/'><svg height='" + (a/5) + "' width='" + (a/2) + "'><image x='0' y='0' height='" + (a/5) + "' xlink:href='./photos/logo_vf_fond_transparent.svg'/></svg></a>")