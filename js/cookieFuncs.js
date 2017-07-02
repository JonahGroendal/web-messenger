/*
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
*/
function readCookie(cookieName) {
   var theCookie=" "+document.cookie;
   var ind=theCookie.indexOf(" "+cookieName+"=");
   if (ind==-1) ind=theCookie.indexOf(";"+cookieName+"=");
   if (ind==-1 || cookieName=="") return "";
   var ind1=theCookie.indexOf(";",ind+1);
   if (ind1==-1) ind1=theCookie.length;
   return unescape(theCookie.substring(ind+cookieName.length+2,ind1));
}
