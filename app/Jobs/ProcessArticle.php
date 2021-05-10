<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use LanguageDetection\Language;


class ProcessArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The article instance
     *
     * @var \App\Models\Article
     */
    protected $article;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Article $article
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parser = new Parser();
        $language = new Language;
        $article = $this->article;
        $pdf = $parser->parseFile(Storage::path($article->path));
        $details = $pdf->getDetails();
        $text = $pdf->getText();

        $article->update([
            'title' => $details['Title'],
            'author' => $details['Author'],
            'pages' => $details['Pages'],
            'text' => $text,
            'language' => array_key_first($language->detect($text)->bestResults()->close())
        ]);
    }
}
