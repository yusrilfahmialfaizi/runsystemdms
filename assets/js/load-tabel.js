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
            var r = [];
            for (i = 0; i < data.length; i++) {//i is index of array
                r.push("<tr>"+
                    "<td>"+data[i].docno+"</td>"+
                    "<td>"+data[i].description+"</td>"+
                    "<td>"+data[i].activeind+"</td>"+
                    "<td>"+data[i].status+"</td>"+
                    "<td>"+data[i].createby+"</td>"+
                    "<td>"+data[i].createdt+"</td>"+
                    "<td>"+data[i].lastupby+"</td>"+
                    "<td>"+data[i].lastupdt+"</td>"+
                    "<td>Edit</td>"+
                    "<tr>"); 
            }
            $("#datacos").html(r);
        }
    });
});