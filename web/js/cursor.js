function onButton()
{
    if(document.querySelector("#formularz_content").textLength == 0)
    {
        document.querySelector("#submitButton").style.cursor="not-allowed"
    }
}
function outButton()
{
    document.querySelector("#submitButton").style.cursor=""
}