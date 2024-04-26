<style>
    :root{
        --background: {{$color->codigo ?? ""}};
        --color: {{$color->letra ?? ""}};
    }

    .hero_area .header_section .header_bottom{
        background: var(--background);
        color: var(--color);
    }

    .hero_area .header_section nav a span,
    .hero_area .header_section #navbarSupportedContent ul li a
    {
        color: var(--color);
    }

    #bgfooter{
        background: var(--background);
    }

    #slider_section .btn1{
        background: var(--background);
    }

    #about h2{
        color: var(--background);
    }

    #service h2 span{
        color: var(--background);
    }

    #start button{
        background: var(--background);
    }

    #contact button{
        background: var(--background);
    }
</style>