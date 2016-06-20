<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                @foreach ($projectList as $project)
                    <a href="<?php echo action('EndpointListController@showList', [
                            'projName' => $project->name
                        ]) ?>" >{!! $project->name !!}</a>
                    <a href="<?php echo action('ProjectListController@removeProject', [
                            'projName' => $project->name
                        ]) ?>" >Remove</a><br/>
                @endforeach
            </div>

            <form method="post" action="{{ action('ProjectListController@addProject') }}">
                {{ csrf_field() }}

                Project Name:
                <input type="text" name="projectName" value="{{ old('projectName') }}"/>
                {{ $errors->first('projectName') }}
                <input type="submit"/>
            </form>
        </div>
    </body>
</html>
