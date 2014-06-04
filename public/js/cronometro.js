$('.hora').each(function(){
        hora = $(this).attr('data-horai').split(",");
        $(this).countup({
            start: new Date(hora[0],hora[1],hora[2],hora[3],hora[4],hora[5])
        });
        $('.countDays').remove();
        $('.countDiv0').remove();
});