        function Register()
{
    var x = document.forms["add"]["username"].value;
    var x1 = document.forms["add"]["password"].value;
    var x2 = document.forms["add"]["password1"].value;
    var x3 = document.forms["add"]["name"].value;
    var x4 = document.forms["add"]["type"].value;
    
    if (x == "") {
        ename.style.visibility="visible";
        
        
        return false;
    }
  if (x1 == "") {
        alert("fill the password");
       
        
        return false;
    }
    if (x2 == "") {
        alert("fill  the confirm password");
       
        
        return false;
    }
    if (x2 != x1) {
        alert("password not equal");
       
        
        return false;
    }
     if (x3 == "") {
        alert("fill  the full name");
       
        
        return false;
    }
     if (x4 == "") {
        alert("fill  the type");
       
        
        return false;
    }
}