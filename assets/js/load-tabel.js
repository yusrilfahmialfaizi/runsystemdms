// get data dynamic sidebar menu 
$(document).ready(function(){
var url = 'http://127.0.0.1:8080/runsystemdms/getDataDocuments';
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        cache: false,
        success: function(data) {
            data = JSON.parse(JSON.stringify(data));
            data = data.datadocument;
            console.log(data);
            for (i = 0; i < data.length; i++) {//i is index of array
                var r = "<tr>"+
                    "<td>"+data.docno+"</td>"+
                "<tr>";
                $("#datadocs").append(r);
            }
        }
    });
});