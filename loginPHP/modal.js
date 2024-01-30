var m1 = document.getElementById('m');

var btn = document.getElementById('cartbutton');

btn.onclick = function() {
    modal.style.display = "block";
}

function showM1()
{
    m1.style.display = "block";
}

function closeM1()
{
	m1.style.display = "none";
	// window.location.href = 'index.php?category=All Products';
}
function closeM1toShop()
{
	m1.style.display = "none";
	window.location.href = 'index.php?category=All Products';
}
function deletecart(pid)
{
	$.post('manipulatecart.php',{pid: pid},function(data)
			{
			}
		);
		
	location.reload();
}

function updatecart(id,updatequantity,cartitem)
{
	$.post('manipulatecart.php',{updatequantity: updatequantity, id: id},function(data)
			{
				$(cartitem+"").text("Php"+data+".00");
				document.getElementById('inputitemtotal').value = data;
			}
		);
		
	$.post('manipulatecart.php',{cartitem: cartitem},function(data)
			{
				$("div#totaldiv").text("Total: Php"+data+".00");
				document.getElementById('totalamount').value = data;
			}
		);
}

window.onclick = function(event)
{
	if (event.target == m1)
	{
        m1.style.display = "none";
    }
}