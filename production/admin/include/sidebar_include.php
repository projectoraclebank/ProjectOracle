<?php $uri = $_SERVER['REQUEST_URI']; ?>
<nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                     <div class="clearfix"></div>
                    <?php 
                    if (preg_match("/dashboard/i",$uri)){
                        ?>
                    <li class="active">
                        <a href="../dashboard/">
                            <i class="fa fa-tachometer fa-fw">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li>
                        <a href="../dashboard/">
                            <i class="fa fa-tachometer fa-fw">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                        <?php
                    }
                    ?>
                    <?php 
                    if (preg_match("/agence/i",$uri)){
                        ?>
                    <li class="active"><a href="../agence/"><i class="fa fa-desktop fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">AGENCE</span></a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li ><a href="../agence/"><i class="fa fa-desktop fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">AGENCE</span></a>
                    </li>
                        <?php
                    }
                    ?>
                    <?php 
                    if (preg_match("/employer/i",$uri)){
                        ?>
                    <li class="active"><a href="../employer/"><i class="fa fa-desktop fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">EMPLOYER</span></a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li ><a href="../employer/"><i class="fa fa-desktop fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">EMPLOYER</span></a>
                    </li>
                        <?php
                    }
                    ?>
                    <?php 
                    if (preg_match("/fonction/i",$uri)){
                        ?>
                    <li class="active"><a href="../fonction/"><i class="fa fa-send-o fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">FONCTION</span></a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li ><a href="../fonction/"><i class="fa fa-send-o fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">FONCTION</span></a>
                    </li>
                        <?php
                    }
                    ?>
                    <?php 
                    if (preg_match("/client/i",$uri)){
                        ?>
                    <li class="active"><a href="../client/"><i class="fa fa-edit fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">CLIENT</span></a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li ><a href="../client/"><i class="fa fa-edit fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">CLIENT</span></a>
                    </li>
                        <?php
                    }
                    ?>
                    <?php 
                    if (preg_match("/compte/i",$uri)){
                        ?>
                    <li class="active"><a href="../compte/"><i class="fa fa-th-list fa-fw">
                        <div class="icon-bg bg-blue"></div>
                    </i><span class="menu-title">COMPTE</span></a>
                    </li>
                        <?php
                    }else{
                        ?>
                    <li ><a href="../compte/"><i class="fa fa-th-list fa-fw">
                        <div class="icon-bg bg-blue"></div>
                    </i><span class="menu-title">COMPTE</span></a>
                    </li>
                        <?php
                    }
                    ?>
                    <!-- fa-database fa-file-o fa-gift fa-sitemap fa-envelope-o fa-bar-chart-o fa-slack-->
                   
                </ul>
            </div>
        </nav>