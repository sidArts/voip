<html>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Sl. no.</th>
                <th>Post Type</th>
                <th>Country</th>
                <th>Quality Level</th>
                <th>Rate</th>
                <th>ASR</th>
                <th>ACD</th>
                <th>Views</th>
                <th>Date Added</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            {posts}
            <tr>
                <td>{post_type}</td>
                <td>{country}</td>
                <td>{quality_level}</td>
                <td>{rate}</td>
                <td>{asr}</td>
                <td>{acd}</td>
                <td>{views}</td>
                <td class="text-right" style="width: 150px;">
                    <a href="<?php print base_url(); ?>posts/view/{id}" class="btn btn-primary btn-xs">view more</a>
                </td>
            </tr>
            {/posts}
        </tbody>
    </table>
</body>
</html>