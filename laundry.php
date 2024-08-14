<?php include "include/header.php";?>
    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="4" data-background="dashboard/uploads/about/<?php print $about_banner;?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption text-center">
                    <h1>Laundry Services</h1>
                </div>
            </div>
        </div>
        <!-- button scroll -->
        <a href="about.html#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
                <span class="mouse-wheel"></span> </span>
        </a>
    </div>
  
<!-- Laundry Price List Section -->
<section class="laundry-list section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">Laundry Price List</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Gentlemens</th>
                                <th>Unit Price $</th>
                                <th></th>
                                <th>Ladies</th>
                                <th>Unit Price $</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Shirt (short sleeves)</td>
                                <td>1.5</td>
                                <td></td>
                                <td>Blouse</td>
                                <td>2.5</td>
                            </tr>
                            <tr>
                                <td>Shirt (Long sleeves)</td>
                                <td>2</td>
                                <td></td>
                                <td>Skirt</td>
                                <td>2.5</td>
                            </tr>
                            <tr>
                                <td>Under shirts</td>
                                <td>0.5</td>
                                <td></td>
                                <td>Dresses</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Under Shorts</td>
                                <td>0.5</td>
                                <td></td>
                                <td>Pajamas</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Pajamas</td>
                                <td>3</td>
                                <td></td>
                                <td>Night Gowns</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Socks</td>
                                <td>0.5</td>
                                <td></td>
                                <td>Slips</td>
                                <td>0.5</td>
                            </tr>
                            <tr>
                                <td>Handkerchiefs</td>
                                <td>0.5</td>
                                <td></td>
                                <td>Panties</td>
                                <td>0.5</td>
                            </tr>
                            <tr>
                                <td>Trousers</td>
                                <td>3</td>
                                <td></td>
                                <td>Handkerchiefs</td>
                                <td>0.5</td>
                            </tr>
                            <tr>
                                <td>Jeans</td>
                                <td>2</td>
                                <td></td>
                                <td>Jeans</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Jackets</td>
                                <td>4</td>
                                <td></td>
                                <td>Trousers</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Shorts</td>
                                <td>2</td>
                                <td></td>
                                <td>Bra</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>T-Shirt</td>
                                <td>1.5</td>
                                <td></td>
                                <td>Bikini</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Swimming Short</td>
                                <td>1.5</td>
                                <td></td>
                                <td>Scarf</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Short</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="disclaimer">
                    <p>Ubucuti Lodge cannot be held responsible for discolouration, shrunken clothes or other damages due to failure to indicate the correct treatment if it differs from the normal ticket in your clothing item.</p>
                    <p>Thanks for your understanding, Ubucuti Lodge</p>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
        /* General styles */
        body {
        
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .section-padding {
            padding: 60px 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table Styles */
        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #aa8453;
            color: white;
        }

        .table td:nth-child(7), .table td:nth-child(8) {
            background-color: #E3B8E2;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Disclaimer */
        .disclaimer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
    
    <?php include "include/footer.php";?>