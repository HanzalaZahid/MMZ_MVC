$(document).ready(
    ()=>{
        let menu    =   $('header .menu');
        let menuButton =   $('header .menu_button');
        let menuCloseButton =   $('header .menu_close_button');

        menuButton.click(
            ()=>{
                menu.css('display','flex');
            }
        )
        menuCloseButton.click(
            ()=>{
                menu.css('display','none');
            }
        )
    }
)