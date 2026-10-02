<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Presto.it - Articolo rifiutato</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="mail-wrapper">

        <div class="card">

            <header class="header">
                <h1>Presto.it</h1>
                <p>Revisione dell'annuncio</p>
            </header>

            <main class="content">

                <h2>Il tuo articolo è stato rifiutato</h2>

                <p class="intro">
                    Il seguente annuncio non ha superato la revisione.
                </p>

                <div class="article-card">

                    @if ($article->thumbnail)
                        <img src="{{ $article->thumbnail }}" alt="Immagine di {{ $article->title }}">
                    @endif

                    <div class="article-info">
                        <span class="label">ARTICOLO</span>

                        <h3>{{ $article->title }}</h3>
                    </div>

                </div>

                @if ($reason)
                    <div class="reason">

                        <span class="label">MOTIVO DEL RIFIUTO</span>

                        <p>{{ $reason }}</p>

                    </div>
                @endif

                <p class="footer-text">
                    Puoi modificare il tuo articolo e inviarlo nuovamente
                    per la revisione.
                </p>

            </main>

            <footer class="footer">
                <p>
                    © {{ date('Y') }} Presto.it
                </p>
            </footer>

        </div>

    </div>

</body>

</html>

<style>
    :root {
        --blk: rgb(51, 51, 51);
        --wh: rgb(255, 254, 242);
        --lgray: rgb(246, 245, 232);
        --dgray: rgb(37, 37, 37);
        --secondary: rgb(108, 117, 125);
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 40px 20px;
        background: linear-gradient(
            135deg,
            #fffef2 0%,
            #f7f5e9 50%,
            #fffef2 100%
        );
        color: var(--blk);
        font-family: 'Inter', Arial, sans-serif;
    }

    .mail-wrapper {
        width: 100%;
        max-width: 680px;
        margin: 0 auto;
    }

    .card {
        overflow: hidden;
        background-color: var(--wh);
        border: 1px solid rgba(51, 51, 51, 0.12);
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(51, 51, 51, 0.10);
    }

    .header {
        padding: 35px 40px;
        background-color: var(--blk);
        text-align: center;
    }

    .header h1 {
        margin: 0;
        color: var(--wh);
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.03em;
    }

    .header p {
        margin: 8px 0 0;
        color: rgba(255, 254, 242, 0.65);
        font-size: 14px;
    }

    .content {
        padding: 45px 40px;
    }

    .content h2 {
        margin: 0 0 12px;
        color: var(--blk);
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 30px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.03em;
    }

    .intro {
        margin: 0 0 30px;
        color: var(--secondary);
        font-size: 15px;
        line-height: 1.6;
    }

    .article-card {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 18px;
        background-color: var(--lgray);
        border: 1px solid rgba(51, 51, 51, 0.10);
        border-radius: 18px;
    }

    .article-card img {
        width: 120px;
        height: 120px;
        flex-shrink: 0;
        object-fit: cover;
        border-radius: 14px;
    }

    .article-info {
        min-width: 0;
    }

    .label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
    }

    .article-info h3 {
        margin: 0;
        color: var(--blk);
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.3;
    }

    .reason {
        margin-top: 25px;
        padding: 22px;
        background-color: rgba(246, 245, 232, 0.65);
        border-left: 4px solid var(--blk);
        border-radius: 12px;
    }

    .reason p {
        margin: 0;
        color: var(--blk);
        font-size: 15px;
        line-height: 1.7;
    }

    .footer-text {
        margin: 30px 0 0;
        color: var(--secondary);
        font-size: 14px;
        line-height: 1.7;
    }

    .footer {
        padding: 22px 40px;
        border-top: 1px solid rgba(51, 51, 51, 0.10);
        text-align: center;
    }

    .footer p {
        margin: 0;
        color: var(--secondary);
        font-size: 12px;
    }

    @media (max-width: 600px) {

        body {
            padding: 20px 10px;
        }

        .content {
            padding: 30px 22px;
        }

        .header {
            padding: 28px 20px;
        }

        .content h2 {
            font-size: 25px;
        }

        .article-card {
            align-items: flex-start;
        }

        .article-card img {
            width: 90px;
            height: 90px;
        }

        .article-info h3 {
            font-size: 17px;
        }

        .footer {
            padding: 20px;
        }
    }
</style>