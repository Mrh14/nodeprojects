<?php
include('templates/header.php');

include('user/includes/json/getdatas.php');

?>
<body>
<section id="hb-paradisecenter" class="hb-paradisecenter v2 hb-sectionspace hb-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                <div class="hb-sectionhead mb-5">
                    <div class="hb-sectiontitle">
                        <h2><span>Bienvenue</span>
                            PAYEMENT
                        </h2>
                    </div>
                    <div class="hb-headcontent">
                        <h2>Choisissez une methode de payement!</h2>
                        <div class="hb-description">
                            <p>Nous vous offrons plusieur methode de payement.</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-xs-12 col-sm-12"  style="text-align: center" >
                    <form action="https://www.sandbox.paypal.com/us/signin">
                    <ul class="list-unstyled hb-paradiselist">
                        <li class="hb-paradisecenterbox">
										<span class="hb-paradiseiconbox">
											<i class="fab fa-paypal"></i>
										</span>
                            <div class="hb-paradisecontent">
                                <h3 class="hb-headingtree">Paypal</h3>
                                <div class="hb-description">
                                        <input type="radio" id="choix" name="choix" > Choisissez PAYPAL
                                </div>
                            </div>
                        </li>
                        <li class="hb-paradisecenterbox">
										<span class="hb-paradiseiconbox">
											<i class="fa fa-bank blue-color"></i>
										</span>
                            <div class="hb-paradisecontent">
                                <h3 class="hb-headingtree">Carte banquaire</h3>
                                <div class="hb-description">
                                    <input type="radio" id="choix" name="choix" > Choisissez Carte banquaire
                                </div>
                            </div>
                        </li>
                        <button type="submit" class="btn btn-primary btn-lg">payer</button>
                    </ul></form>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

<?php include('templates/footer.php');?>