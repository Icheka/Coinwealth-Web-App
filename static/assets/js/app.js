function mobileMenu(){
    const menu = document.getElementById("mobilemenu");
    const img = document.getElementById("cheeseburger");

    if (menu.style.left == "-780px"){
        var action = "open";
    } else {
        var action = "close";
    }
    if (document.body.onclick && menu.style.left=="0px"){
        action = "close";
    }

    if (action == "open"){
        menu.style.left = "0px";
        img.setAttribute("src", "static/images/icons/cheeseburger_close.png");
    }
    if (action == "close"){
        menu.style.left = "-780px";
        img.setAttribute("src", "static/images/icons/cheeseburger_icon.png");
    }
}

/*..
* Testimonials carousel
..*/
//$(document).ready(function() {
    $(".testimonial-carousel").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      arrows: true,
      prevArrow: $(".testimonial-carousel-controls .prev"),
      nextArrow: $(".testimonial-carousel-controls .next")
    });
//});