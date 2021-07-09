<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<li class="open"><a href="/admin"><i class="fa fa-dashboard"></i> Hlavní stránka</a></li>
				<li><a href="#"><i class="fa fa-clock-o"></i> Tikety</a>
					<ul>
						<li><a href="?strana=tikety_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=tikety_seznam"><i class="fa fa-arrow-right"></i>Seznam</a></li>  
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-th-list"></i> Zápasy</a>
					<ul>
						<li><a href="?strana=zapasy_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=zapasy_seznam"><i class="fa fa-arrow-right"></i>Seznam</a></li>
            <li><a href="?strana=zapasy_stream_preview"><i class="fa fa-arrow-right"></i>Stream & preview</a></li>  
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-desktop"></i> Soutěž</a>
					<ul>
						<li><a href="?strana=soutez_pridat_vyherce"><i class="fa fa-arrow-right"></i>Přidat výherce</a></li>                                                                       
            <li><a href="?strana=soutez_seznam_vyhercu"><i class="fa fa-arrow-right"></i>Seznam výherců</a></li>  
            <li><a href="?strana=soutez_tabulka"><i class="fa fa-arrow-right"></i>Tabulka</a></li>
            <li><a href="?strana=soutez_resetovat"><i class="fa fa-arrow-right"></i>Resetovat soutěž</a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-pie-chart"></i> Statistiky</a>
					<ul>
						<li><a href="?strana=statistiky_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=statistiky_seznam"><i class="fa fa-arrow-right"></i>Seznam</a></li>  
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-calendar-o"></i> Události</a>
					<ul>
						<li><a href="?strana=udalosti_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=udalosti_seznam"><i class="fa fa-arrow-right"></i>Seznam</a></li>  
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-dot-circle-o"></i> Coiny</a>
					<ul>
						<li><a href="?strana=coiny_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=coiny_historie"><i class="fa fa-arrow-right"></i>Historie pohybů</a></li>  
            <li><a href="?strana=coiny_seznam_uzivatelu"><i class="fa fa-arrow-right"></i>Seznam uživatelů s coinama</a></li>
					</ul>
				</li>          
				<li><a href="#"><i class="fa fa-users"></i> Uživatelé</a>
					<ul>
						<li><a href="?strana=uzivatele_pridat"><i class="fa fa-arrow-right"></i>Přidat</a></li>                                                                       
            <li><a href="?strana=uzivatele_seznam"><i class="fa fa-arrow-right"></i>Seznam</a></li>  
            <li><a href="?strana=uzivatele_seznam_premium"><i class="fa fa-arrow-right"></i>Seznam premium uživatelů</a></li>
            <li><a href="?strana=uzivatele_seznam_klub365"><i class="fa fa-arrow-right"></i>Seznam klub 365 uživatelů</a></li>
            <li><a href="?strana=emaily_export"><i class="fa fa-arrow-right"></i>E-mail export</a></li>
            <li> <a href="?strana=uzivatele_online"><i class="fa fa-arrow-right"></i>Online</a></li>
					</ul>
				</li>                         
				<li><a href="#"><i class="fa fa-files-o"></i> Stránky s texty</a>
					<ul>
<?php
$sql = dibi::fetchAll('SELECT nazev,seo FROM stranky');
foreach($sql as $row) { 
echo"<li><a href=\"?strana=stranky&seo=".$row['seo']."\"><i class='fa fa-arrow-right'></i>".$row['nazev']."</a></li>";
}
?>
					</ul>
				</li>
				<li><a href="?strana=nastaveni"><i class="fa fa-edit"></i> Nastavení a záloha</a></li>
        
				<!-- Account from above -->
				<!-- Account from above -->
				<ul class="ts-profile-nav">
					<li><a href="?strana=odhlasit">Odhlásit se</a></li>
					<li><a href="../">Přejít na web</a></li>
				</ul>

			</ul>
</nav>