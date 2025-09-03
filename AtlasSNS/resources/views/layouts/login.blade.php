<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>



<body>
    <header>
        <div id="head">
            <h1><a href="/top"><img src="{{ asset('images/atlas.png') }}"></a></h1>

            <div id="user-menu">
                {{-- クリックで開くエリア --}}
                <div class="user-toggle js-accordion-toggle">
                    <p>
                        <strong>{{ Auth::user()->username }} さん</strong>
                        <img src="{{ asset('images/' . trim(Auth::user()->images ?? 'default.png')) }}" alt="ユーザーアイコン" width="50">
                    </p>
                </div>

                {{-- 開閉されるメニューエリア --}}
                <div class="js-accordion-menu" style="display: none;">
                    <ul>
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile">プロフィール</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <div id="row">
        <div id="container">
            @yield('content')
            <!-- ↑他のビューから挿入される中身（＝子ビューの中身）が入ります。 -->
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }} さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->follows()->count() }} 名</p>
                </div>
                <p class="btn"><a href="follow-list">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->followers()->count() }} 名</p>
                </div>
                <p class="btn"><a href="follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- jQuery読み込み -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- BootstrapのJS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- 独自JS（ここでscript.jsを読み込む） -->
    <script src="{{ asset('js/script.js') }}"></script>


</body>

</html>
