<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post Details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posted By <?php print $post->name.' ('.$post->username.')' ?></div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Post Type</th>
                            <td><?php print $post->post_type; ?></td>
                        </tr>
                        <tr>
                            <th>Quality Level</th>
                            <td><?php print $post->quality_level ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?php print $post->country ?></td>
                        </tr>
                        <tr>
                            <th>ASR</th>
                            <td><?php print $post->asr ?></td>
                        </tr>
                        <tr>
                            <th>ACD</th>
                            <td><?php print $post->acd ?></td>
                        </tr>
                        <tr>
                            <th>Rate</th>
                            <td><?php print $post->rate ?></td>
                        </tr>
                        <tr>
                            <th>Views</th>
                            <td><?php print $post->views ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php print $post->description ?></td>
                        </tr>
                        <tr>
                            <th>Date Added</th>
                            <td><?php print date('F j, Y, g:i a', strtotime($post->created_at)) ?></td>
                        </tr>
                        <tr>
                            <th>Views</th>
                            <td><?php print $post->views ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>