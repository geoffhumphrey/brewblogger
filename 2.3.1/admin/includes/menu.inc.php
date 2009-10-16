<?php  { ?>
<script type="text/javascript" language="JavaScript">

/***********************************************
* AnyLink Drop Down Menu- ? Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var menu1=new Array()  // Public side Admin Menu
menu1[0]='<a href="index.php?action=list&dbTable=adjuncts">Manage Adjuncts</a>'
menu1[1]='<a href="index.php?action=add&dbTable=adjuncts">&nbsp;&nbsp;- Add Adjuncts</a>'
menu1[2]='<a href="index.php?action=list&dbTable=extract">Manage Extracts</a>'
menu1[3]='<a href="index.php?action=add&dbTable=extract">&nbsp;&nbsp;- Add Extracts</a>'
menu1[4]='<a href="index.php?action=list&dbTable=malt">Manage Grains</a>'
menu1[5]='<a href="index.php?action=add&dbTable=malt">&nbsp;&nbsp;- Add Grains</a>'
menu1[6]='<a href="index.php?action=list&dbTable=hops">Manage Hops</a>'
menu1[7]='<a href="index.php?action=add&dbTable=hops">&nbsp;&nbsp;- Add Hops</a>'
menu1[8]='<a href="index.php?action=list&dbTable=misc">Manage Misc. Ingredients</a>'
menu1[9]='<a href="index.php?action=add&dbTable=misc">&nbsp;&nbsp;- Add Misc. Ingredients</a>'
menu1[10]='<a href="index.php?action=list&dbTable=styles">Manage Styles</a>'
menu1[11]='<a href="index.php?action=add&dbTable=styles">&nbsp;&nbsp;- Add Styles</a>'
menu1[12]='<a href="index.php?action=list&dbTable=equip_profiles">Manage Equipment Profiles</a>'
menu1[13]='<a href="index.php?action=add&dbTable=equip_profiles">&nbsp;&nbsp;- Add Equipment Profiles</a>'
menu1[14]='<a href="index.php?action=list&dbTable=mash_profiles">Manage Mash Profiles</a>'
menu1[15]='<a href="index.php?action=add&dbTable=mash_profiles">&nbsp;&nbsp;- Add Mash Profiles</a>'
menu1[16]='<a href="index.php?action=list&dbTable=water_profiles">Manage Water Profiles</a>'
menu1[17]='<a href="index.php?action=add&dbTable=water_profiles">&nbsp;&nbsp;- Add Water Profiles</a>'
menu1[18]='<a href="index.php?action=list&dbTable=yeast_profiles">Manage Yeast Profiles</a>'
menu1[19]='<a href="index.php?action=add&dbTable=yeast_profiles">&nbsp;&nbsp;- Add Yeast Profiles</a>'

var menu2=new Array() // Admin BrewBlogs Menu
menu2[0]='<a href="index.php?action=list&dbTable=brewing">Manage <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu2[1]='<a href="index.php?action=add&dbTable=brewing">&nbsp;&nbsp;- Add <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu2[2]='<a href="index.php?action=importXML&dbTable=brewing">&nbsp;&nbsp;- Import BeerXML</a>'
menu2[5]='<a href="index.php?action=list&dbTable=upcoming">Manage Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu2[6]='<a href="index.php?action=add&dbTable=upcoming">&nbsp;&nbsp;- Add Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu2[7]='<a href="index.php?action=list&dbTable=reviews">Manage Reviews</a>'
menu2[8]='<a href="index.php?action=list&dbTable=awards">Manage <?php echo $row_pref['menuAwards']; ?></a>'

var menu3=new Array() // Admin Recipes Menu
menu3[0]='<a href="index.php?action=list&dbTable=recipes">Manage <?php echo $row_pref['menuRecipes']; ?></a>'
menu3[1]='<a href="index.php?action=add&dbTable=recipes">&nbsp;&nbsp;- Add <?php echo $row_pref['menuRecipes']; ?></a>'
menu3[2]='<a href="index.php?action=importXML&dbTable=recipes">&nbsp;&nbsp;- Import BeerXML</a>'

var menu4=new Array() // Admin General Menu
menu4[0]='<a href="index.php?action=edit&dbTable=brewer&id=1">Edit Profile</a>'
menu4[1]='<a href="index.php?action=list&dbTable=brewerlinks">Manage Links</a>'
menu4[2]='<a href="index.php?action=add&dbTable=brewerlinks">&nbsp;&nbsp;- Add Links</a>'
menu4[3]='<a href="index.php?action=list&dbTable=brewingcss">Manage Themes</a>'
menu4[4]='<a href="index.php?action=add&dbTable=brewingcss">&nbsp;&nbsp;- Add Themes</a>'
menu4[5]='<a href="index.php?action=list&dbTable=users">Manage Users</a>'
menu4[6]='<a href="index.php?action=add&dbTable=users">&nbsp;&nbsp;- Add Users</a>'
menu4[7]='<a href="index.php?action=edit&dbTable=preferences&id=1">Edit Preferences</a>'

var menu5=new Array() // Admin Calculators Menu (not used as of v2.3) 
/* menu5[0]='<a href="#" onClick="window.open(\'tools/calculate.php?section=bitterness\',\'\',\'height=620,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Bitterness Calculator</a>'
menu5[7]='<a href="#" onClick="window.open(\'tools/calculate.php?section=water\',\'\',\'height=275,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Water Amounts Calculator</a>'
menu5[2]='<a href="#" onClick="window.open(\'tools/calculate.php?section=calories\',\'\',\'height=300,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Calories, Alcohol, and Plato Calculator</a>'
menu5[1]='<a href="#" onClick="window.open(\'tools/calculate.php?section=efficiency\',\'\',\'height=575,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Brewhouse Efficiency Calculator</a>'
menu5[5]='<a href="#" onClick="window.open(\'tools/calculate.php?section=sugar\',\'\',\'height=440,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Priming Sugar Calculator</a>'
menu5[3]='<a href="#" onClick="window.open(\'tools/calculate.php?section=force_carb\',\'\',\'height=400,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Force Carbonation Calculator</a>'
menu5[4]='<a href="#" onClick="window.open(\'tools/calculate.php?section=plato\',\'\',\'height=225,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Plato/Brix/SG Calculator</a>'
menu5[6]='<a href="#" onClick="window.open(\'tools/calculate.php?section=strike\',\'\',\'height=400,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;">Strike Water Temperature Calculator</a>'
menu5[9]='<a href="index.php?action=calculate&source=calculator">Recipe Calculator</a>'
menu5[8]='<a href="index.php?action=chooseRecalc">Recalculate Recipe or Log</a>'
*/

var menu6=new Array() // Admin << Back To... menu
menu6[1]='<a href="../index.php?page=about">Brewer Profile</a>'
menu6[4]='<a href="../index.php?page=brewBlogCurrent">Current</a>'
menu6[5]='<a href="../index.php?page=brewBlogList"><?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu6[6]='<a href="../index.php?page=recipeList"><?php echo $row_pref['menuRecipes']; ?></a>'
menu6[7]='<a href="../index.php?page=reference"><?php echo $row_pref['menuReference']; ?></a>'
menu6[2]='<a href="../index.php?page=tools"><?php echo $row_pref['menuCalculators']; ?></a>'
menu6[0]='<a href="../index.php?page=awardsList&sort=awardBrewName&dir=ASC"><?php echo $row_pref['menuAwards']; ?></a>'
menu6[3]='<a href="../index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a>'

var menu7=new Array()  // Adimin Help menu
menu7[0]='<a href="https://sourceforge.net/forum/forum.php?forum_id=564469" target="_blank">Help Forum</a>'
menu7[1]='<a href="https://sourceforge.net/tracker/?group_id=165855&atid=837037" target="_blank">Report a Bug</a>'
menu7[2]='<a href="https://sourceforge.net/tracker/?group_id=165855&atid=837040" target="_blank">Request a Feature</a>'
menu7[3]='<a href="https://sourceforge.net/tracker/?group_id=165855&atid=837038" target="_blank">Request Support</a>'

// Club version User Level 2 menus

var menu8=new Array() // Public << Back to.. Menu
menu8[0]='<a href="index.php?action=list&dbTable=brewing">Manage <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu8[1]='<a href="index.php?action=add&dbTable=brewing">&nbsp;&nbsp;- Add <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu8[3]='<a href="admin/index.php?action=importXML&dbTable=brewing">&nbsp;&nbsp;- Import BeerXML to <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu8[6]='<a href="index.php?action=list&dbTable=recipes">Manage <?php echo $row_pref['menuRecipes']; ?></a>'
menu8[7]='<a href="index.php?action=add&dbTable=recipes">&nbsp;&nbsp;- Add <?php echo $row_pref['menuRecipes']; ?></a>'
menu8[8]='<a href="index.php?action=importXML&dbTable=recipes">&nbsp;&nbsp;- Import BeerXML to <?php echo $row_pref['menuRecipes']; ?></a>'
menu8[9]='<a href="index.php?action=list&dbTable=recipes&view=copy">&nbsp;&nbsp;- Copy/Import Other User <?php echo $row_pref['menuRecipes']; ?></a>'
menu8[4]='<a href="index.php?action=list&dbTable=upcoming">Manage Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu8[5]='<a href="index.php?action=add&dbTable=upcoming">&nbsp;&nbsp;- Add Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu8[10]='<a href="index.php?action=list&dbTable=awards">Manage <?php echo $row_pref['menuAwards']; ?></a>'


var menu9=new Array() //
menu9[0]='<a href="index.php?action=list&dbTable=adjuncts">List Adjuncts</a>'
menu9[1]='<a href="index.php?action=add&dbTable=adjuncts">&nbsp;&nbsp;- Add Adjuncts</a>'
menu9[2]='<a href="index.php?action=list&dbTable=equip_profiles">List Equipment Profiles</a>'
menu9[3]='<a href="index.php?action=add&dbTable=equip_profiles">&nbsp;&nbsp;- Add Equipment Profiles</a>'
menu9[4]='<a href="index.php?action=list&dbTable=extract">List Extracts</a>'
menu9[5]='<a href="index.php?action=add&dbTable=extract">&nbsp;&nbsp;- Add Extracts</a>'
menu9[6]='<a href="index.php?action=list&dbTable=malt">List Grains</a>'
menu9[7]='<a href="index.php?action=add&dbTable=malt">&nbsp;&nbsp;- Add Grains</a>'
menu9[8]='<a href="index.php?action=list&dbTable=hops">List Hops</a>'
menu9[9]='<a href="index.php?action=add&dbTable=hops">&nbsp;&nbsp;- Add Hops</a>'
menu9[10]='<a href="index.php?action=list&dbTable=styles">List Styles</a>'
menu9[11]='<a href="index.php?action=add&dbTable=styles">&nbsp;&nbsp;- Add Styles</a>'
menu9[12]='<a href="index.php?action=list&dbTable=users">List Users</a>'
menu9[13]='<a href="index.php?action=list&dbTable=water_profiles">List Water Profiles</a>'
menu9[14]='<a href="index.php?action=add&dbTable=water_profiles">&nbsp;&nbsp;- Add Water Profiles</a>'
menu9[15]='<a href="index.php?action=list&dbTable=yeast_profiles">List Yeast Profiles</a>'
menu9[16]='<a href="index.php?action=add&dbTable=yeast_profiles">&nbsp;&nbsp;- Add Yeast Profiles</a>'

// menu10 no longer used

var menu11=new Array()
menu11[0]='<a href="../index.php?page=awardsList&sort=awardBrewName&dir=ASC"><?php echo $row_pref['menuAwards']; ?></a>'
menu11[1]='<a href="../index.php?page=brewBlogList&sort=brewDate&dir=DESC"><?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu11[2]='<a href="../index.php?page=members&sort=realLastName&dir=ASC"><?php echo $row_pref['menuMembers']; ?></a>'
menu11[3]='<a href="../index.php?page=about">Profile</a>'
menu11[4]='<a href="../index.php?page=recipeList"><?php echo $row_pref['menuRecipes']; ?></a>'
menu11[5]='<a href="../index.php?page=tools"><?php echo $row_pref['menuCalculators']; ?></a>'
menu11[7]='<a href="../index.php?page=reference"><?php echo $row_pref['menuReference']; ?></a>'
menu11[6]='<a href="../index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a>'

// menu12 no longer used

<?php if ($row_user['userLevel'] == "1") { ?>
var menu13=new Array()
menu13[0]='<a href="admin/index.php">Admin Home</a>'
menu13[1]='<a href="admin/index.php?action=list&dbTable=brewing">Manage <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu13[2]='<a href="admin/index.php?action=list&dbTable=recipes">Manage <?php echo $row_pref['menuRecipes']; ?></a>'
menu13[3]='<a href="admin/index.php?action=list&dbTable=awards">Manage <?php echo $row_pref['menuAwards']; ?></a>'
menu13[4]='<a href="admin/index.php?action=list&dbTable=upcoming">Manage Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu13[5]='<a href="admin/index.php?action=edit&dbTable=preferences&id=1">Edit Preferences</a>'
menu13[6]='<a href="admin/index.php?action=importXML">Import BeerXML</a>'
menu13[7]='<a href="admin/index.php?action=chooseRecalc">Recalculate a Recipe or Log</a>'
menu13[8]='<a href="admin/index.php?action=calculate">Recipe Calculator</a>'
<?php } ?>

<?php if ($row_user['userLevel'] == "2") { ?>
var menu13=new Array()
menu13[0]='<a href="admin/index.php">Admin Home</a>'
menu13[1]='<a href="admin/index.php?action=list&dbTable=brewing">Manage <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu13[2]='<a href="admin/index.php?action=list&dbTable=recipes">Manage <?php echo $row_pref['menuRecipes']; ?></a>'
menu13[3]='<a href="admin/index.php?action=list&dbTable=upcoming">Manage Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
<?php } ?>

// menu14 no longer used

var menu15=new Array()
menu15[0]='<a href="index.php?page=reference&section=styles">BJCP Style Information</a>'
menu15[1]='<a href="index.php?page=reference&section=carbonation">Carbonation Chart</a>'
menu15[3]='<a href="index.php?page=reference&section=hops">Hops</a>'
menu15[4]='<a href="index.php?page=reference&section=grains">Malts and Grains</a>'
menu15[2]='<a href="index.php?page=reference&section=color">Color Chart</a>'
menu15[5]='<a href="index.php?page=reference&section=yeast">Yeast</a>'

var menu16=new Array()
menu16[0]='<a href="index.php?page=tools&section=bitterness">Bitterness Calculator</a>'
menu16[1]='<a href="index.php?page=tools&section=efficiency">Brewhouse Efficiency Calculator</a>'
menu16[2]='<a href="index.php?page=tools&section=calories">Calories, Alcohol, and Plato Calculator</a>'
menu16[3]='<a href="index.php?page=tools&section=force_carb">Force Carbonation Calculator</a>'
menu16[5]='<a href="index.php?page=tools&section=plato">Plato/Brix/SG Calculator</a>'
menu16[6]='<a href="index.php?page=tools&section=sugar">Priming Sugar Calculator</a>'
menu16[7]='<a href="index.php?page=tools&section=strike">Strike Water Temperature Calculator</a>'
menu16[8]='<a href="index.php?page=tools&section=water">Water Amounts Calculator</a>'
menu16[4]='<a href="index.php?page=tools&section=hyd">Hydrometer Correction Calculator</a>'

var menu17=new Array()
menu17[0]='<a href="admin/index.php?action=list&dbTable=brewing">Manage <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu17[2]='<a href="admin/index.php?action=list&dbTable=recipes">Manage <?php echo $row_pref['menuRecipes']; ?></a>'
menu17[3]='<a href="admin/index.php?action=list&dbTable=recipes&view=copy">Copy/Import Other User <?php echo $row_pref['menuRecipes']; ?></a>'
menu17[1]='<a href="admin/index.php?action=list&dbTable=upcoming">Manage Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu17[4]='<a href="admin/index.php?action=list&dbTable=awards">Manage <?php echo $row_pref['menuAwards']; ?></a>'
menu17[9]='<a href="admin/index.php?action=importXML">Import BeerXML to <?php echo $row_pref['menuBrewBlogs']; ?></a>'
menu17[10]='<a href="admin/index.php?action=importXML">Import BeerXML to <?php echo $row_pref['menuRecipes']; ?></a>'
menu17[11]='<a href="admin/index.php?action=chooseRecalc">Recalculate a Recipe or Log</a>'
menu17[12]='<a href="admin/index.php?action=calculate">Recipe Calculator</a>'


var menuwidth='250px' 		//default menu width
var menubgcolor=''  		//menu bgcolor
var disappeardelay='50' 		//menu disappear speed onMouseout (in miliseconds)
var hidemenu_onclick="no" 	//hide menu when user clicks within menu?

/////No further editing needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu

</script>
<?php } ?>