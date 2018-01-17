/**
 * Created by Martin on 17.01.2018.
 */
function setCookies(){
    var exdays=1; // safes cookies 5 days long !
    var cookieString="";
    $('[name="CurrencyRowValue"]').each(function( index ) {
        if($( this ).prev().prev().val()>0){
            cookieString=cookieString+[$( this ).prev().find("option:selected").text()]+"->"+$( this ).prev().prev().val()+"|";
        }
    });

    cname="Coins"
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cookieString + ";" + expires + ";path=/";

    var exchange;
    exchange=$('[name="money"]').find("option:selected").text();
    cname="Exchange"
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + exchange + ";" + expires + ";path=/";

}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}