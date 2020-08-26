
//almacenar slider en una variable
var slider=$('#slider');

//almacenar los botones en una variable
var siguiente=$('#btn-next');
var anterior=$('#btn-prev');

//mover ultima imagen al primer lugar
$('#slider section:last').insertBefore('#slider section:first');


//mover a la primera imagen a -100%
slider.css('margin-left', '-'+100+'%');

function moverD()
{
	slider.animate({
	marginLeft:'-'+200+'%'
	},700, function(){
	 $('#slider section:first').insertAfter
	 ('#slider section:last');
	 slider.css('margin-left', '-'+100+'%');

	});
}

function moverI()
{
	slider.animate({
	marginLeft:0
	},700, function(){
     $('#slider section:last').insertBefore
	 ('#slider section:first');
	 slider.css('margin-left', '-'+100+'%');
	});
}

siguiente.on('click', function()
{
	moverD();
});

anterior.on('click', function()
{
	moverI();
});


function autoplay()
{
	interval=setInterval(function()
	{
		moverD();
	}, 5000);
}

autoplay();