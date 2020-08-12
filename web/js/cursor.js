function onButton()
{
    if(document.querySelector("#formularz_content").textLength == 0)
    {
        document.querySelector("#przyciskWyslij").style.cursor="not-allowed"
    }
}
function outButton()
{
    document.querySelector("#przyciskWyslij").style.cursor=""
}