    <div class="main-grid">
        <div class="social grid">
            <div class="grid-info">
                <div id="grid"></div>
                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view("partials/parts/foot") ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var url = 'http://127.0.0.1:8080/runsystemdms/getPG';
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    data = JSON.parse(JSON.stringify(data));
                    data = data.pg;
                    for (i = 0; i < data.length; i++) {
                        var grid = '<div class="col-md-3 top-comment-grid" style="margin : 5px"><div class="comments tweets"><div class="comments-icon"><i class="fa fa-twitter"></i></div><div class="comments-info tweets-info"><h2 style="color:white;">' + data[i].pgcode + '</h2><a href="#">' + data[i].pgname + '</a></div><div class="clearfix"> </div></div></div>';
                        $("#grid").append(grid)
                    }
                }
            });
        });
    </script>