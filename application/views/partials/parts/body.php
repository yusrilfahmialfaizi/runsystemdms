<body class="dashboard-page">
    <script>
            var theme = $.cookie('protonTheme') || 'default';
            $('body').removeClass (function (index, css) {
                return (css.match (/\btheme-\S+/g) || []).join(' ');
            });
            if (theme !== 'default') $('body').addClass(theme);
        </script>
    <?php $this->load->view("partials/parts/sidebar") ?>
    <section class="wrapper scrollable">
        <?php $this->load->view("partials/parts/navbar") ?>
        <?php $this->load->view("partials/parts/titlebar") ?>