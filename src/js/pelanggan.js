$(document).ready(function(){
    // event ketika keyword ditulis
    $('#pencarian').on('keyup', function(){
        $('#container').load('../html/ajaxPelanggan.php?pencarian='+$('#pencarian').val())
    });
});