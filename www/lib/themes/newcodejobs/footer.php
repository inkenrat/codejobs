        <div class="clear"></div>

        <footer>
            <p>
            <?php
                if(get("ready")) {
            ?>
                    <a href="<?php print path(slug(__(_("Advertising"))), FALSE, FALSE); ?>"><?php print __(_("Advertising")); ?></a> &nbsp;&nbsp;
                    <a href="<?php print path(slug(__(_("Legal notice"))), FALSE, FALSE); ?>"><?php print __(_("Legal notice")); ?></a>  &nbsp;&nbsp;
                    <a href="<?php print path(slug(__(_("Terms of Use"))), FALSE, FALSE); ?>"><?php print __(_("Terms of Use")); ?></a>  &nbsp;&nbsp;
                    <a href="<?php print path(slug(__(_("About CodeJobs"))), FALSE, FALSE); ?>"><?php print __(_("About CodeJobs")); ?></a> &nbsp;&nbsp;
            		<a href="<?php print path("feedback"); ?>"><?php print __(_("Contact us")); ?></a><br /> 
			<?php 
                } else {
                    echo "<br />";
                }
            ?>  

               <?php print __(_("This site is licensed under a")); ?> 
                <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">Creative Commons Attribution 3.0 License</a>. 
                <?php print __(_("Powered by")); ?> <a href="http://www.milkzoft.com" target="_blank">MilkZoft</a>
            </p>
        </footer>

        <?php print $this->getJs(); ?>
    </body>
</html>