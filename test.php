<form onsubmit="return false;">
<label for "bar_code">Item</label>
<input
name="bar_code"
id="bar_code" 
onchange = "processBarCode('getitemdetails.php', this.value);"
onfocus="setStyle(this.id);"
autofocus
>
</form>