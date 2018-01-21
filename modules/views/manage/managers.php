
	<!-- main container -->
    <div class="content">
      
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>Users</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="Type a user's name..." />
                        
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->
                        <div class="ui-dropdown">
                            <div class="head" data-toggle="tooltip" title="Click me!">
                                Filter users
                                <i class="arrow-down"></i>
                            </div>  
                            <div class="dialog">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                                <div class="body">
                                    <p class="title">
                                        Show users where:
                                    </p>
                                    <div class="form">
                                        <select>
                                            <option />Name
                                            <option />Email
                                            <option />Number of orders
                                            <option />Signed up
                                            <option />Last seen
                                        </select>
                                        <select>
                                            <option />is equal to
                                            <option />is not equal to
                                            <option />is greater than
                                            <option />starts with
                                            <option />contains
                                        </select>
                                        <input type="text" />
                                        <a class="btn-flat small">Add filter</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo yii\helpers\Url::to(['manage/manageadd']); ?>" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            添加管理员
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span1 sortable">
                                    用户ID
                                </th>
                                <th class="span2 sortable">
                                    用户名
                                </th>
                                <th class="span3 sortable">
                                    <span class="line"></span>登录时间
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>登录IP
                                </th>
                                <th class="span3 sortable">
                                    <span class="line"></span>邮箱
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($managers as $manage): ?>
                        <!-- row -->
                        <tr class="first">
                            <td>
                                <a href="user-profile.html" class="name"><?php echo $manage->adminid; ?></a>
                            </td>
                            <td>
                                <span class="subtext"><?php echo $manage->adminuser; ?></span>
<!--                                <img src="img/contact-img.png" class="img-circle avatar hidden-phone" />-->

                            </td>
                            <td>
                                <?php echo date('Y-m-d H:i:s', $manage->logintime); ?>
                            </td>
                            <td>
                                <?php echo long2ip($manage->loginip); ?>
                            </td>
                            <td>
                                <a href="#"><?php echo $manage->adminemail; ?></a>
                            </td>
                            <td class="align-right">
                                添加
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <!----row end---->

                        </tbody>
                    </table>
                </div>
                <div class="pagination pull-right">
                    <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pager, 'prevPageLabel' => '&#8249;', 'nextPageLabel' => '&#8250;']);?>
                </div>
                <!-- end users table -->
            </div>
        </div>
    </div>
    <!-- end main container -->