    <?php

    $this->load->view('_components/modal');

    ?>

    <!-- PLACE <SCRIPT> TAG HERE  -->

    <!-- Bootstrap 5.0.2 JS -->
    
    <script src="<?= site_url() ?>/assets/src/js/style.js"></script>
    <script>
        const getFullMonth = month => {
            switch (month) {
                case 0:
                    return 'Januari'
                    break;
                case 1:
                    return 'Februari'
                    break;
                case 2:
                    return 'Maret'
                    break;
                case 3:
                    return 'April'
                    break;
                case 4:
                    return 'Mei'
                    break;
                case 5:
                    return 'Juni'
                    break;
                case 6:
                    return 'Juli'
                    break;
                case 7:
                    return 'Agustus'
                    break;
                case 8:
                    return 'September'
                    break;
                case 9:
                    return 'Oktober'
                    break;
                case 10:
                    return 'November'
                    break;
                case 11:
                    return 'Desember'
                    break;
                default:
                    break;
            }
        }
    </script>
        
    </body>

    </html>
