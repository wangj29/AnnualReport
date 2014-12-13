<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav" id="side-menu">

            <li><?php echo anchor('committee','Committee');?></li>
            <li><?php echo anchor('course','Course');?></li>
            <li><?php echo anchor('evaluation','Evaluation');?></li>
            <li><?php echo anchor('publication','Publication');?></li>
            <li>
                <a href="<?php echo base_url() ?>index.php/mentoring">Mentoring<span class="fa arrow"></span></a>
             <!--   <ul>  class="nav nav-second-level" --> 
                    <li>
                        <?php echo anchor('mentoring/thesis','&nbsp;&nbsp;&nbsp;&nbspMaster Thesis Student');?>  
                    </li>
                     <li>
                        <?php echo anchor('mentoring/graduate','&nbsp;&nbsp;&nbsp;&nbspGraduate Student');?>  
                    </li>
                     <li>
                        <?php echo anchor('mentoring/undergraduate','&nbsp;&nbsp;&nbsp;&nbspUndergraduate Student');?>  
                    </li>
            <!--    </ul> 
            -->                               
            </li>	
            <li><?php echo anchor('award','Award');?></li>		
            <li><?php echo anchor('annual_report','Annual Report');?></li>

        </ul>
    </div>
</nav>

