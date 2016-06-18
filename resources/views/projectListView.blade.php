<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                <a href="{{ action('ModificationController@showList') }}">Modification List</a><br/><br/>

                @foreach ($projectList as $project)
                    <a href="{{ action('EndpointListController@showList', [ 'projName' => $project->name ]) }}" >{!! $project->name !!}</a><br/>
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
