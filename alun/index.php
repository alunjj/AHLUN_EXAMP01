<form action="" method="POST">
    <label for="employee">Employee/User:</label><br>
    <select id="employee" name="employee" onchange="getDetail(1)">
    </select> 
    <input type="text" id="nama" name="nama" HIDDEN>   
    <br>
    <label for="no_barang">No Barang:</label><br>
    <input type="text" id="no_barang" name="no_barang" readonly><br>
    <label for="nama_barang">Nama Barang:</label><br>
    <input type="text" id="nama_barang" name="nama_barang"><br>
    <label for="harga">Harga:</label><br>
    <input type="text" id="harga" name="harga" onkeyup="hitungtotal()"><br>
    <label for="harga">Disc:</label><br>
    <input type="text" id="disc" name="disc" onkeyup="hitungtotal()">%<br>
    <label for="total">Total:</label><br>
    <input type="text" id="total" name="total" readonly><br>
    <input type="submit" value="Submit">
</form> 
<?php 
if (isset($_POST['employee'])) {
    echo '<table border="1">';
    echo '<thead>';
        echo '<tr>';
            echo '<th>Employee</th>';
            echo '<th>No Barang</th>';
            echo '<th>Nama Barang</th>';
            echo '<th>Harga</th>';
            echo '<th>Disc</th>';
            echo '<th>Total</th>';
        echo '<tr>';
    echo '</thead>';
    echo '<tbody>';
        echo '<tr>';
            echo '<th>'.$_POST['nama'].'</th>';
            echo '<th>'.$_POST['no_barang'].'</th>';
            echo '<th>'.$_POST['nama_barang'].'</th>';
            echo '<th>'.$_POST['harga'].'</th>';
            echo '<th>'.$_POST['disc'].'%</th>';
            echo '<th>'.$_POST['total'].'</th>';
        echo '<tr>';
    echo '</tbody>';
    echo '</table>';
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $.ajax({
        url: "https://financed.4netps.co.id/ujian/employee",
        type: "get",
        data: {} ,
        success: function (response) {
            console.log(response);
            for (i = 0; i < response.length; i++)
            { 
                $('#employee').append( '<option value="'+i+'">'+''+response[i].NAME+'</option>' );
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });

    function getDetail(idxc) {
        if (idxc==1) {
            var idx = $('#employee').val();
        }else{
            var idx=0;
        }
        
        console.log(idx);
        $.ajax({
            url: "https://financed.4netps.co.id/ujian/employee",
            type: "get",
            data: {} ,
            success: function (response) {
                console.log(response[idx]);
                let numb = response[idx].ID;
                let text = numb.toString();
                var id = response[idx].CODE_DEPT+ text.padStart(4,0);
                console.log(id)
                $('#no_barang').val(id);
                $('#nama').val(response[idx].NAME);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    }

    function hitungtotal(){
        var harga = $('#harga').val();
        var disc  = $('#disc').val();
        if (parseFloat(disc) > 0) {
            var total = parseFloat(harga)-(parseFloat(harga)*parseFloat(disc)/100);
        }else{
            var total = parseFloat(harga);
        }
        
        $('#total').val(total);
    }

    getDetail(0);
</script>

