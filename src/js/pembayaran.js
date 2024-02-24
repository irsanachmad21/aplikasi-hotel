$(document).ready(function(){
    // event ketika keyword ditulis
    $('#pencarian').on('keyup', function(){
        $('#container').load('../html/ajaxPembayaran.php?pencarian='+$('#pencarian').val())
    });
});

function NewWindow(mypage, myname, w, h, scroll, x, y) {
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winl = x;
    wint = y;
    winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+	',resizable'
    win = window.open(mypage, myname, winprops)
    if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}