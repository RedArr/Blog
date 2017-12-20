<?php $__env->startSection("content"); ?>
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title"><?php echo e($post->title); ?></h2>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update',$post)): ?>
                <a style="margin: auto"  href="/posts/<?php echo e($post->id); ?>/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete',$post)): ?>
                <a style="margin: auto"  href="/posts/<?php echo e($post->id); ?>/delete">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
                    <?php endif; ?>
            </div>

            <p class="blog-post-meta"><?php echo e($post->created_at->toDayDateTimeString()); ?> by <a href="#"><?php echo e($post->user->name); ?></a></p>

            <?php echo $post->content; ?>

            <div>
                <a href="/posts/<?php echo e($post->id); ?>/zan" type="button" class="btn btn-primary btn-lg">赞</a>

            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <h5>2017-05-28 10:15:08 by Kassandra Ankunding2</h5>
                    <div>
                        这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论这是第一个评论
                    </div>
                </li>
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/comment" method="post">
                    <input type="hidden" name="post_id" value="62"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout.main", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>