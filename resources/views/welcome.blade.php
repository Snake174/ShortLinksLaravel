<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Сервис по сокращению ссылок</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
  <meta name="format-detection" content="telephone=no" />
  <meta http-equiv="x-rim-auto-match" content="none">
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <meta name="mobile-web-app-capable" content="yes" />
  <meta name="robots" content="index, follow" />
  <meta name="revisit-after" content="1 days" />
  <meta name="keywords" content="" />
  <meta name="description" content="Сервис по сокращению ссылок" />
  <meta name="author" content="Serebryannikov Evgeny" />
  <meta name="copyright" content="Serebryannikov Evgeny" />
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="icon" href="/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    #wrap {
      flex: 1;
      -ms-flex-preferred-size: auto;
      margin: 10px auto -60px;
    }
  </style>
</head>
<body>
<div id="wrap">
  <div class="container">
  <div class="row">
    <div class=" col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          {!! Form::open(['action' => 'UrlController@generate']) !!}
          <div class="input-group">
            <input type="text" class="form-control" placeholder="URL" name="dst_url" />
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit" id="generate">Сгенерировать</button>
            </span>
          </div>
          {!! Form::close() !!}
        </div>
        <div class="panel-footer">
          @if ($dstURL != null)
            @if ($dstURL == '')
              <div class="alert alert-danger">Не удалось сгенерировать ссылку. Попробуйте ещё раз.</div>
            @else
              <a href="{{ $dstURL }}" target="_blank">{{ $dstURL }}</a>
            @endif
          @endif

          @if ($errors->any())
            <div class="container">
              <div class="row">
                <div class="col-xs-10">
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>   
      </div>
    </div>
  </div>
  </div>
</div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
