<?php

namespace App\Http\Controllers;

use App\Models\WebApp;
use App\Models\User;
use App\Models\Opd;
use App\Models\HealthCheckBatch;
use App\Models\HealthCheckResult;
use App\Jobs\CheckAllWebsitesJob;
use App\Jobs\ProcessHealthCheckJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UserMonitoringController extends Controller
{
    /**
     * Get the OPD ID of the authenticated user.
     */
    private function getOpdId()
    {
        return auth()->user()->opd_id;
    }

    /**
     * Base query scoped to user's OPD.
     */
    private function scopedQuery()
    {
        return WebApp::where('opd_id', $this->getOpdId());
    }

    /**
     * Monitoring Overview Dashboard (scoped to user's OPD)
     */
    public function index(Request $request)
    {
        $opdId = $this->getOpdId();
        $opd = Opd::find($opdId);

        // Summary stats for overview (scoped to OPD)
        $stats = [
            'total_apps' => $this->scopedQuery()->count(),
            'total_users' => User::where('opd_id', $opdId)->count(),
            'apps_with_repo' => $this->scopedQuery()->where(function($q) {
                $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
            })->count(),
        ];

        // Known frameworks for smart extraction
        $jenisAppStats = $this->scopedQuery()
            ->select('jenis_aplikasi', DB::raw('count(*) as total'))
            ->groupBy('jenis_aplikasi')
            ->orderByDesc('total')
            ->get();

        // Known frameworks for smart extraction (mega expanded list - synced with admin)
        $knownFrameworks = [
            // PHP Frameworks
            'laravel', 'codeigniter', 'ci', 'yii', 'yii2', 'symfony', 'cakephp', 'slim', 'lumen', 'phalcon', 'zend', 'zf', 'fuel', 'fuelphp', 'kohana', 'fatfree', 'f3', 'aura', 'nette', 'silex', 'typo3', 'flow', 'lithium', 'flight', 'medoo', 'phpixie', 'pop php', 'agavi', 'phpunit', 'behat', 'codeception', 'phaser', 'moodle', 'phpmyadmin',
            // JavaScript Frontend Frameworks
            'vue', 'vuejs', 'vue.js', 'vue2', 'vue3', 'react', 'reactjs', 'react.js', 'react 18', 'angular', 'angularjs', 'angular.js', 'angular2', 'angular 17', 'svelte', 'sveltejs', 'svelte.js', 'sveltekit', 'ember', 'emberjs', 'ember.js', 'backbone', 'backbonejs', 'backbone.js', 'preact', 'inferno', 'mithril', 'riot', 'riotjs', 'marko', 'hyperapp', 'alpine', 'alpinejs', 'alpine.js', 'stimulus', 'turbo', 'hotwire', 'htmx', 'unpoly', 'petite-vue', 'solidjs', 'solid', 'qwik', 'lit', 'lit-html', 'stencil',
            // JavaScript Meta Frameworks
            'next', 'nextjs', 'next.js', 'next 14', 'nuxt', 'nuxtjs', 'nuxt.js', 'nuxt 3', 'gatsby', 'gatsbyjs', 'gatsby.js', 'remix', 'astro', 'eleventy', '11ty', 'vuepress', 'vitepress', 'docusaurus', 'gridsome', 'blitz', 'blitzjs', 'redwood', 'redwoodjs', 'fresh', 'sapper',
            // JavaScript Backend Frameworks
            'express', 'expressjs', 'express.js', 'fastify', 'koa', 'koajs', 'koa.js', 'hapi', 'hapijs', 'hapi.js', 'nest', 'nestjs', 'nest.js', 'adonis', 'adonisjs', 'adonis.js', 'feathers', 'feathersjs', 'feathers.js', 'sails', 'sailsjs', 'sails.js', 'meteor', 'meteorjs', 'meteor.js', 'loopback', 'strapi', 'keystone', 'keystonejs', 'directus', 'payload', 'medusa', 'vendure', 'moleculer', 'seneca', 'nodal', 'total.js', 'actionhero', 'restify', 'polka', 'micro', 'fastapi-js', 'tsed', 'foal', 'encore',
            // CSS Frameworks & UI Libraries
            'bootstrap', 'bootstrap5', 'bootstrap 5', 'bootstrap4', 'bootstrap 4', 'tailwind', 'tailwindcss', 'tailwind css', 'bulma', 'foundation', 'materialize', 'materializecss', 'material ui', 'mui', 'semantic ui', 'semanticui', 'uikit', 'pure', 'pure css', 'purecss', 'milligram', 'skeleton', 'spectre', 'spectre.css', 'tachyons', 'basscss', 'primer', 'ant design', 'antd', 'chakra', 'chakra ui', 'mantine', 'radix', 'radix ui', 'headless ui', 'headlessui', 'shadcn', 'daisy ui', 'daisyui', 'flowbite', 'primefaces', 'primevue', 'primereact', 'vuetify', 'quasar', 'element ui', 'element plus', 'naive ui', 'arco design', 'vant', 'nutui', 'windicss', 'windi', 'unocss',
            // JS Libraries
            'jquery', 'zepto', 'lodash', 'underscore', 'ramda', 'rxjs', 'axios', 'fetch', 'superagent', 'got', 'moment', 'dayjs', 'date-fns', 'luxon', 'chart.js', 'chartjs', 'd3', 'd3js', 'd3.js', 'echarts', 'highcharts', 'apexcharts', 'plotly', 'three.js', 'threejs', 'three', 'babylon', 'babylonjs', 'pixi', 'pixijs', 'p5', 'p5js', 'konva', 'fabric', 'fabricjs', 'paper', 'paperjs', 'anime', 'animejs', 'gsap', 'framer motion', 'motion', 'lottie', 'socket.io', 'socketio', 'ws', 'primus', 'pusher', 'ably', 'webpack', 'vite', 'rollup', 'parcel', 'esbuild', 'swc', 'babel', 'eslint', 'prettier', 'jest', 'mocha', 'jasmine', 'cypress', 'playwright', 'puppeteer', 'selenium', 'redux', 'mobx', 'zustand', 'jotai', 'recoil', 'pinia', 'vuex', 'xstate', 'tanstack query', 'react query', 'swr', 'apollo', 'urql', 'relay', 'trpc', 'graphql', 'prisma', 'typeorm', 'sequelize', 'knex', 'objection', 'drizzle', 'kysely', 'mongoose', 'nextauth', 'auth.js', 'passport', 'lucia', 'supabase', 'firebase', 'amplify', 'appwrite', 'pocketbase', 'convex', 'neon', 'planetscale', 'turso', 'xata', 'upstash', 'vercel', 'netlify', 'cloudflare', 'workers', 'deno', 'bun', 'electron', 'tauri', 'neutralino', 'capacitor', 'expo',
            // Python Frameworks
            'django', 'flask', 'fastapi', 'pyramid', 'tornado', 'bottle', 'cherrypy', 'falcon', 'sanic', 'starlette', 'aiohttp', 'quart', 'responder', 'hug', 'vibora', 'japronto', 'masonite', 'web2py', 'turbogears', 'pylons', 'twisted', 'dash', 'streamlit', 'gradio', 'panel', 'voila', 'nicegui', 'reflex', 'pynecone', 'flet', 'textual', 'rich', 'typer', 'click', 'fire', 'celery', 'dramatiq', 'rq', 'huey', 'arq', 'pytest', 'unittest', 'nose', 'behave', 'robot', 'locust', 'scrapy', 'beautifulsoup', 'bs4', 'selenium', 'playwright', 'requests', 'httpx', 'aiohttp', 'urllib3', 'pydantic', 'attrs', 'dataclasses', 'marshmallow', 'sqlalchemy', 'peewee', 'tortoise', 'databases', 'alembic', 'flask-sqlalchemy', 'django-rest-framework', 'drf', 'ninja', 'graphene', 'strawberry', 'ariadne', 'numpy', 'pandas', 'scipy', 'matplotlib', 'seaborn', 'plotly', 'bokeh', 'altair', 'scikit-learn', 'sklearn', 'tensorflow', 'keras', 'pytorch', 'jax', 'xgboost', 'lightgbm', 'catboost', 'opencv', 'pillow', 'pil', 'spacy', 'nltk', 'gensim', 'transformers', 'huggingface', 'langchain', 'llamaindex', 'autogen', 'crewai',
            // Java Frameworks
            'spring', 'springboot', 'spring boot', 'spring mvc', 'spring security', 'spring data', 'spring cloud', 'struts', 'struts2', 'hibernate', 'jpa', 'mybatis', 'jsf', 'primefaces', 'grails', 'vaadin', 'wicket', 'play', 'play framework', 'dropwizard', 'micronaut', 'quarkus', 'helidon', 'vert.x', 'vertx', 'spark java', 'javalin', 'blade', 'ninja', 'ratpack', 'jersey', 'resteasy', 'cxf', 'axis', 'gwt', 'tapestry', 'seam', 'ejb', 'jee', 'jakarta', 'osgi', 'karaf', 'felix', 'junit', 'testng', 'mockito', 'easymock', 'powermock', 'cucumber', 'maven', 'gradle', 'ant', 'lombok', 'mapstruct', 'jackson', 'gson', 'guava', 'commons', 'log4j', 'slf4j', 'logback', 'netty', 'akka', 'reactor', 'rxjava', 'completablefuture',
            // C# / .NET Frameworks
            'asp.net', 'asp.net core', '.net', '.net core', '.net framework', 'dotnet', 'blazor', 'blazor server', 'blazor wasm', 'razor', 'razor pages', 'mvc', 'webapi', 'web api', 'signalr', 'grpc', 'minimal api', 'entity framework', 'ef', 'ef core', 'dapper', 'nhibernate', 'linq', 'wpf', 'winforms', 'uwp', 'maui', 'xamarin', 'xamarin.forms', 'avalonia', 'uno', 'orleans', 'akka.net', 'mediatr', 'autofac', 'ninject', 'unity', 'structuremap', 'hangfire', 'quartz', 'polly', 'refit', 'flurl', 'restsharp', 'serilog', 'nlog', 'log4net', 'xunit', 'nunit', 'mstest', 'moq', 'nsubstitute', 'automoq', 'specflow', 'bogus', 'autofixture', 'benchmark.net', 'fluentvalidation', 'humanizer', 'automapper', 'mapster', 'newtonsoft', 'system.text.json', 'protobuf', 'messagepack',
            // Ruby Frameworks
            'rails', 'ruby on rails', 'ror', 'sinatra', 'hanami', 'padrino', 'grape', 'roda', 'cuba', 'rack', 'rom', 'dry-rb', 'rom-rb', 'sequel', 'activerecord', 'rspec', 'minitest', 'capybara', 'factory_bot', 'faker', 'sidekiq', 'resque', 'delayed_job', 'good_job', 'devise', 'warden', 'omniauth', 'cancancan', 'pundit', 'rolify', 'hotwire', 'stimulus', 'turbo', 'importmap', 'webpacker', 'sprockets', 'propshaft',
            // Go Frameworks
            'gin', 'echo', 'fiber', 'chi', 'gorilla', 'mux', 'beego', 'buffalo', 'revel', 'iris', 'fasthttp', 'gorm', 'ent', 'sqlx', 'sqlc', 'gokit', 'micro', 'kratos', 'zerolog', 'zap', 'logrus', 'cobra', 'viper', 'wire', 'fx', 'testify', 'ginkgo', 'gomega', 'goconvey',
            // Rust Frameworks
            'actix', 'actix-web', 'axum', 'rocket', 'warp', 'tide', 'tower', 'hyper', 'tokio', 'async-std', 'diesel', 'sqlx', 'sea-orm', 'serde', 'clap', 'structopt', 'tracing', 'config', 'leptos', 'yew', 'dioxus', 'tauri',
            // Mobile Frameworks
            'flutter', 'react native', 'reactnative', 'expo', 'ionic', 'capacitor', 'cordova', 'phonegap', 'xamarin', 'nativescript', 'kivy', 'beeware', 'toga', 'jetpack compose', 'compose', 'swiftui', 'uikit', 'appkit', 'android', 'ios',
            // CMS & eCommerce
            'wordpress', 'wp', 'drupal', 'joomla', 'typo3', 'concrete5', 'october', 'october cms', 'craft', 'craft cms', 'statamic', 'grav', 'ghost', 'contentful', 'sanity', 'strapi', 'directus', 'payload', 'cockpit', 'prismic', 'storyblok', 'dato', 'butter', 'forestry', 'tina', 'magento', 'prestashop', 'opencart', 'woocommerce', 'shopware', 'sylius', 'spree', 'solidus', 'medusa', 'saleor', 'vendure', 'shopify', 'bigcommerce', 'squarespace', 'wix', 'webflow',
            // Testing Frameworks
            'jest', 'mocha', 'jasmine', 'karma', 'ava', 'tape', 'vitest', 'cypress', 'playwright', 'puppeteer', 'selenium', 'webdriver', 'nightwatch', 'testcafe', 'codeceptjs', 'detox', 'appium', 'espresso', 'xctest',
            // Other
            'native', 'vanilla', 'custom', 'proprietary', 'in-house', 'none', 'tidak ada', 'lainnya'
        ];

        $frameworkCounts = [];
        $this->scopedQuery()->whereNotNull('framework')->pluck('framework')->each(function ($value) use (&$frameworkCounts, $knownFrameworks) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownFrameworks as $fw) {
                    if (preg_match('/\b(' . preg_quote($fw, '/') . ')\s*([\d\.]+)?\s*(.*)/i', $item, $matches)) {
                        $name = ucfirst(strtolower($matches[1]));
                        $frameworkCounts[$name] = ($frameworkCounts[$name] ?? 0) + 1;
                        $found = true;
                        $remaining = trim($matches[3] ?? '');
                        if ($remaining) {
                            foreach ($knownFrameworks as $fw2) {
                                if (preg_match('/\b(' . preg_quote($fw2, '/') . ')\s*([\d\.]+)?/i', $remaining, $m2)) {
                                    $name2 = ucfirst(strtolower($m2[1]));
                                    $frameworkCounts[$name2] = ($frameworkCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                if (!$found && $item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $frameworkCounts[$baseName] = ($frameworkCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($frameworkCounts);
        $topFrameworks = collect($frameworkCounts)
            ->map(fn($total, $name) => (object)['framework' => $name, 'total' => $total]);

        // Known programming languages for smart extraction (mega expanded list - synced with admin)
        $knownLanguages = [
            // Web Languages
            'php', 'php5', 'php7', 'php8', 'javascript', 'js', 'ecmascript', 'es6', 'es2015', 'es2020', 'typescript', 'ts', 'html', 'html4', 'html5', 'xhtml', 'css', 'css2', 'css3', 'sass', 'scss', 'less', 'stylus', 'postcss',
            // General Purpose
            'python', 'python2', 'python3', 'java', 'c#', 'csharp', 'c-sharp', 'c++', 'cpp', 'cplusplus', 'go', 'golang', 'rust', 'ruby', 'swift', 'kotlin', 'dart', 'scala', 'groovy', 'clojure', 'elixir', 'erlang', 'haskell', 'f#', 'fsharp', 'ocaml', 'nim', 'crystal', 'zig', 'vlang', 'dlang', 'ada', 'modula', 'oberon',
            // Mobile Development
            'objective-c', 'objc', 'objective c', 'swift', 'kotlin', 'dart', 'java', 'c#',
            // Scripting Languages
            'perl', 'perl5', 'perl6', 'raku', 'lua', 'luajit', 'shell', 'sh', 'bash', 'zsh', 'fish', 'powershell', 'ps1', 'batch', 'bat', 'cmd', 'vbscript', 'vbs', 'applescript', 'osascript', 'awk', 'sed', 'grep', 'tcl', 'tk', 'expect', 'autohotkey', 'ahk', 'autoit',
            // Data Science & Scientific
            'rlang', 'r-lang', 'matlab', 'octave', 'julia', 'sas', 'spss', 'stata', 'mathematica', 'wolfram', 'maple', 'scilab', 'labview', 'simulink', 'fortran', 'fortran77', 'fortran90', 'fortran95', 'f77', 'f90', 'f95',
            // Database & Query Languages
            'sql', 'mysql', 'postgresql', 'postgres', 'sqlite', 'oracle', 'mssql', 'sqlserver', 'mariadb', 'db2', 'sybase', 'informix', 'plsql', 'pl/sql', 'tsql', 't-sql', 'plpgsql', 'nosql', 'mongodb', 'cql', 'cassandra', 'aql', 'arangodb', 'cypher', 'neo4j', 'gremlin', 'sparql', 'graphql', 'hql', 'hibernate', 'jpql', 'n1ql', 'couchbase',
            // Functional Languages
            'lisp', 'common lisp', 'scheme', 'racket', 'clojure', 'clojurescript', 'elm', 'purescript', 'reason', 'reasonml', 'rescript', 'bucklescript', 'sml', 'standard ml', 'miranda', 'clean', 'idris', 'agda', 'coq', 'lean', 'isabelle',
            // Legacy & Enterprise
            'cobol', 'cobol85', 'cobol2002', 'fortran', 'pascal', 'turbo pascal', 'object pascal', 'delphi', 'freepascal', 'lazarus', 'basic', 'qbasic', 'quickbasic', 'gwbasic', 'visual basic', 'vb', 'vb6', 'vb.net', 'vba', 'vbscript', 'xbase', 'clipper', 'dbase', 'foxpro', 'visual foxpro', 'harbour', 'pl/i', 'pli', 'natural', 'adabas', 'jcl', 'rexx', 'clist', 'rpg', 'rpgle', 'cl', 'mumps', 'cache', 'intersystems',
            // Assembly & Low Level
            'assembly', 'asm', 'x86', 'x64', 'x86-64', 'amd64', 'i386', 'i686', 'arm', 'arm64', 'aarch64', 'mips', 'mips64', 'sparc', 'powerpc', 'ppc', 'riscv', 'risc-v', 'avr', 'pic', 'z80', '6502', '8086', 'nasm', 'masm', 'gas', 'fasm', 'yasm', 'llvm', 'ir', 'bitcode', 'wasm', 'webassembly', 'wat',
            // Markup & Data Formats
            'xml', 'xslt', 'xpath', 'xquery', 'dtd', 'xsd', 'json', 'json5', 'jsonc', 'yaml', 'yml', 'toml', 'ini', 'cfg', 'conf', 'properties', 'markdown', 'md', 'rst', 'restructuredtext', 'asciidoc', 'adoc', 'textile', 'wiki', 'mediawiki', 'latex', 'tex', 'bibtex', 'troff', 'groff', 'man', 'pod', 'rdoc', 'javadoc', 'jsdoc', 'docstring',
            // Domain Specific
            'regex', 'regexp', 'bnf', 'ebnf', 'antlr', 'yacc', 'bison', 'flex', 'lex', 'peg', 'parsec', 'makefile', 'make', 'cmake', 'ninja', 'meson', 'gradle', 'maven', 'ant', 'rake', 'gulp', 'grunt', 'webpack', 'dockerfile', 'docker', 'kubernetes', 'helm', 'terraform', 'hcl', 'pulumi', 'ansible', 'puppet', 'chef', 'salt', 'vagrant', 'packer',
            // Game Development
            'gdscript', 'godot', 'unrealscript', 'uscript', 'blueprints', 'blueprint', 'unityscript', 'boo', 'angelscript', 'squirrel', 'haxe', 'openfl', 'flixel', 'game maker', 'gml', 'rpg maker', 'ruby', 'renpy', 'inform', 'twine', 'ink', 'choicescript',
            // Blockchain & Smart Contracts
            'solidity', 'vyper', 'move', 'rust', 'clarity', 'michelson', 'ligo', 'smartpy', 'cadence', 'ink', 'reach', 'scilla', 'plutus', 'marlowe', 'aiken',
            // Hardware Description
            'vhdl', 'verilog', 'systemverilog', 'sv', 'spice', 'hspice', 'spectre', 'chisel', 'bluespec', 'bsv', 'migen', 'amaranth', 'clash', 'myhdl',
            // AI & ML Related
            'tensorflow', 'pytorch', 'keras', 'onnx', 'tribuo', 'mlir', 'cuda', 'opencl', 'glsl', 'hlsl', 'metal', 'spirv', 'cg', 'shaderlab',
            // Other & Esoteric
            'coffeescript', 'coffee', 'livescript', 'actionscript', 'as3', 'flex', 'mxml', 'apex', 'visualforce', 'abap', 'sap', 'progress', 'openedge', 'abl', '4gl', '4d', 'powerbuilder', 'clarion', 'xojo', 'realbasic', 'purebasic', 'freebasic', 'gambas', 'smalltalk', 'pharo', 'squeak', 'self', 'io', 'ioke', 'shen', 'factor', 'forth', 'postscript', 'eps', 'pdf', 'prolog', 'mercury', 'datalog', 'clips', 'jess', 'drools', 'oz', 'mozart', 'alice', 'concurrent ml', 'occam', 'limbo', 'newsqueak', 'alef', 'oberon', 'component pascal', 'active oberon', 'zonnon', 'seed7', 'icon', 'unicon', 'snobol', 'spitbol', 'simula', 'beta', 'gbeta', 'eiffel', 'cecil', 'dylan', 'goo', 'slate', 'strongtalk', 'newspeak', 'dart', 'ceylon', 'fantom', 'gosu', 'xtend', 'frege', 'eta', 'kawa', 'sisc', 'gnu guile', 'chicken scheme', 'gambit', 'bigloo', 'chez', 'larceny', 'mit scheme', 'scm', 'ikarus', 'vicare', 'ironscheme',
            // Indonesian/Local Terms
            'tidak diketahui', 'lainnya', 'other', 'unknown', 'none', 'tidak ada', '-'
        ];

        $bahasaCounts = [];
        $this->scopedQuery()->whereNotNull('bahasa_pemrograman')->pluck('bahasa_pemrograman')->each(function ($value) use (&$bahasaCounts, $knownLanguages) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownLanguages as $lang) {
                    if (preg_match('/\b(' . preg_quote($lang, '/') . ')\s*([\d\.]+)?\s*(.*)/i', $item, $matches)) {
                        $name = strtoupper($matches[1]);
                        if (in_array(strtolower($matches[1]), ['javascript', 'typescript', 'python', 'java', 'golang', 'ruby', 'swift', 'kotlin', 'dart', 'html', 'css', 'perl', 'matlab', 'scala', 'groovy', 'lua', 'shell', 'bash', 'powershell'])) {
                            $name = ucfirst(strtolower($matches[1]));
                        }
                        $bahasaCounts[$name] = ($bahasaCounts[$name] ?? 0) + 1;
                        $found = true;
                        $remaining = trim($matches[3] ?? '');
                        if ($remaining) {
                            foreach ($knownLanguages as $lang2) {
                                if (preg_match('/\b(' . preg_quote($lang2, '/') . ')\s*([\d\.]+)?/i', $remaining, $m2)) {
                                    $name2 = strtoupper($m2[1]);
                                    if (in_array(strtolower($m2[1]), ['javascript', 'typescript', 'python', 'java', 'golang', 'ruby', 'swift', 'kotlin'])) {
                                        $name2 = ucfirst(strtolower($m2[1]));
                                    }
                                    $bahasaCounts[$name2] = ($bahasaCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                if (!$found && $item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $bahasaCounts[$baseName] = ($bahasaCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($bahasaCounts);
        $bahasaStats = collect($bahasaCounts)
            ->map(fn($total, $name) => (object)['bahasa_pemrograman' => $name, 'total' => $total]);

        // DBMS stats
        $dbmsCounts = [];
        $this->scopedQuery()->whereNotNull('dbms')->pluck('dbms')->each(function ($value) use (&$dbmsCounts) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if ($item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $dbmsCounts[$baseName] = ($dbmsCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($dbmsCounts);
        $dbmsStats = collect(array_slice($dbmsCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['dbms' => $name, 'total' => $total]);

        // Architecture distribution
        $arsitekturStats = $this->scopedQuery()
            ->select('arsitektur_sistem', DB::raw('count(*) as total'))
            ->groupBy('arsitektur_sistem')
            ->get();

        // Library/Package Stats (scoped to OPD)
        $libCounts = [];
        $this->scopedQuery()->whereNotNull('daftar_library_package')->where('daftar_library_package', '!=', '')
            ->pluck('daftar_library_package')->each(function ($value) use (&$libCounts) {
                $items = array_map('trim', explode(',', $value));
                foreach ($items as $item) {
                    if (!$item) continue;
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName);
                    if ($baseName) {
                        $libCounts[$baseName] = ($libCounts[$baseName] ?? 0) + 1;
                    }
                }
            });
        arsort($libCounts);
        $libraryStats = collect($libCounts)
            ->map(fn($total, $name) => (object)['library' => $name, 'total' => $total]);

        // Repository Stats
        $punyaRepo = $this->scopedQuery()->where(function($q) {
            $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
        })->count();
        $tidakRepo = $stats['total_apps'] - $punyaRepo;
        $hasRepoStats = collect([
            (object)['has_repository' => 'ya', 'total' => $punyaRepo],
            (object)['has_repository' => 'tidak', 'total' => $tidakRepo],
        ]);

        $gitTypeStats = $this->scopedQuery()
            ->select('git_repository', DB::raw('count(*) as total'))
            ->whereNotNull('git_repository')
            ->groupBy('git_repository')
            ->get();

        $providerStats = $this->scopedQuery()
            ->select('penyedia_repository', DB::raw('count(*) as total'))
            ->whereNotNull('penyedia_repository')
            ->groupBy('penyedia_repository')
            ->orderByDesc('total')
            ->get();

        // Database Stats
        $lokasiStats = $this->scopedQuery()
            ->select('lokasi_database', DB::raw('count(*) as total'))
            ->groupBy('lokasi_database')
            ->get();

        $aksesStats = $this->scopedQuery()
            ->select('akses_database', DB::raw('count(*) as total'))
            ->groupBy('akses_database')
            ->get();

        $versiStats = $this->scopedQuery()
            ->select('versi_dbms', DB::raw('count(*) as total'))
            ->groupBy('versi_dbms')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // OPD Stats (read-only all OPDs)
        $opdStats = Opd::withCount('webApps')->orderByDesc('web_apps_count')->get();
        $emptyOpds = $opdStats->where('web_apps_count', 0);
        $avgAppsPerOpd = round(WebApp::count() / max(Opd::count(), 1), 1);
        $topOpds = $opdStats->take(10);
        $myOpdId = $this->getOpdId();

        // Global stats for ALL OPDs panel
        $allTotalApps = WebApp::count();

        // Global Framework stats
        $allFrameworkCounts = [];
        WebApp::whereNotNull('framework')->pluck('framework')->each(function ($value) use (&$allFrameworkCounts, $knownFrameworks) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownFrameworks as $fw) {
                    if (preg_match('/\b(' . preg_quote($fw, '/') . ')\s*([\d\.]+)?\s*(.*)/i', $item, $matches)) {
                        $name = ucfirst(strtolower($matches[1]));
                        $allFrameworkCounts[$name] = ($allFrameworkCounts[$name] ?? 0) + 1;
                        $found = true;
                        $remaining = trim($matches[3] ?? '');
                        if ($remaining) {
                            foreach ($knownFrameworks as $fw2) {
                                if (preg_match('/\b(' . preg_quote($fw2, '/') . ')\s*([\d\.]+)?/i', $remaining, $m2)) {
                                    $name2 = ucfirst(strtolower($m2[1]));
                                    $allFrameworkCounts[$name2] = ($allFrameworkCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                if (!$found && $item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $allFrameworkCounts[$baseName] = ($allFrameworkCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($allFrameworkCounts);
        $allTopFrameworks = collect($allFrameworkCounts)
            ->map(fn($total, $name) => (object)['framework' => $name, 'total' => $total]);

        // Global Bahasa stats
        $allBahasaCounts = [];
        WebApp::whereNotNull('bahasa_pemrograman')->pluck('bahasa_pemrograman')->each(function ($value) use (&$allBahasaCounts, $knownLanguages) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownLanguages as $lang) {
                    if (preg_match('/\b(' . preg_quote($lang, '/') . ')\s*([\d\.]+)?\s*(.*)/i', $item, $matches)) {
                        $name = strtoupper($matches[1]);
                        if (in_array(strtolower($matches[1]), ['javascript', 'typescript', 'python', 'java', 'golang', 'ruby', 'swift', 'kotlin', 'dart', 'html', 'css', 'perl', 'matlab', 'scala', 'groovy', 'lua', 'shell', 'bash', 'powershell'])) {
                            $name = ucfirst(strtolower($matches[1]));
                        }
                        $allBahasaCounts[$name] = ($allBahasaCounts[$name] ?? 0) + 1;
                        $found = true;
                        $remaining = trim($matches[3] ?? '');
                        if ($remaining) {
                            foreach ($knownLanguages as $lang2) {
                                if (preg_match('/\b(' . preg_quote($lang2, '/') . ')\s*([\d\.]+)?/i', $remaining, $m2)) {
                                    $name2 = strtoupper($m2[1]);
                                    if (in_array(strtolower($m2[1]), ['javascript', 'typescript', 'python', 'java', 'golang', 'ruby', 'swift', 'kotlin'])) {
                                        $name2 = ucfirst(strtolower($m2[1]));
                                    }
                                    $allBahasaCounts[$name2] = ($allBahasaCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                if (!$found && $item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $allBahasaCounts[$baseName] = ($allBahasaCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($allBahasaCounts);
        $allBahasaStats = collect($allBahasaCounts)
            ->map(fn($total, $name) => (object)['bahasa_pemrograman' => $name, 'total' => $total]);

        // Global DBMS stats
        $allDbmsCounts = [];
        WebApp::whereNotNull('dbms')->pluck('dbms')->each(function ($value) use (&$allDbmsCounts) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if ($item) {
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName) ?: $item;
                    $allDbmsCounts[$baseName] = ($allDbmsCounts[$baseName] ?? 0) + 1;
                }
            }
        });
        arsort($allDbmsCounts);
        $allDbmsStats = collect($allDbmsCounts)
            ->map(fn($total, $name) => (object)['dbms' => $name, 'total' => $total]);

        // Global Architecture stats
        $allArsitekturStats = WebApp::select('arsitektur_sistem', DB::raw('count(*) as total'))
            ->groupBy('arsitektur_sistem')->get();

        // Global Repository stats
        $allPunyaRepo = WebApp::where(function($q) {
            $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
        })->count();
        $allHasRepoStats = collect([
            (object)['has_repository' => 'ya', 'total' => $allPunyaRepo],
            (object)['has_repository' => 'tidak', 'total' => $allTotalApps - $allPunyaRepo],
        ]);
        $allGitTypeStats = WebApp::select('git_repository', DB::raw('count(*) as total'))
            ->whereNotNull('git_repository')->groupBy('git_repository')->get();
        $allProviderStats = WebApp::select('penyedia_repository', DB::raw('count(*) as total'))
            ->whereNotNull('penyedia_repository')->groupBy('penyedia_repository')->orderByDesc('total')->get();

        // Global Database stats
        $allLokasiStats = WebApp::select('lokasi_database', DB::raw('count(*) as total'))
            ->groupBy('lokasi_database')->get();
        $allAksesStats = WebApp::select('akses_database', DB::raw('count(*) as total'))
            ->groupBy('akses_database')->get();
        $allVersiStats = WebApp::select('versi_dbms', DB::raw('count(*) as total'))
            ->groupBy('versi_dbms')->orderByDesc('total')->limit(10)->get();

        // Global Jenis Aplikasi stats
        $allJenisAppStats = WebApp::select('jenis_aplikasi', DB::raw('count(*) as total'))
            ->groupBy('jenis_aplikasi')->orderByDesc('total')->get();

        // Global Library/Package Stats
        $allLibCounts = [];
        WebApp::whereNotNull('daftar_library_package')->where('daftar_library_package', '!=', '')
            ->pluck('daftar_library_package')->each(function ($value) use (&$allLibCounts) {
                $items = array_map('trim', explode(',', $value));
                foreach ($items as $item) {
                    if (!$item) continue;
                    $baseName = preg_replace('/\s+[\d\.x]+$/i', '', $item);
                    $baseName = trim($baseName);
                    if ($baseName) {
                        $allLibCounts[$baseName] = ($allLibCounts[$baseName] ?? 0) + 1;
                    }
                }
            });
        arsort($allLibCounts);
        $allLibraryStats = collect($allLibCounts)
            ->map(fn($total, $name) => (object)['library' => $name, 'total' => $total]);

        return view('monitoring.index', compact(
            'opd', 'stats', 'jenisAppStats', 'topFrameworks', 'bahasaStats', 'dbmsStats', 'arsitekturStats',
            'libraryStats',
            'hasRepoStats', 'gitTypeStats', 'providerStats',
            'lokasiStats', 'aksesStats', 'versiStats',
            'opdStats', 'emptyOpds', 'avgAppsPerOpd', 'topOpds', 'myOpdId',
            'allTotalApps', 'allTopFrameworks', 'allBahasaStats', 'allDbmsStats', 'allArsitekturStats',
            'allLibraryStats',
            'allHasRepoStats', 'allGitTypeStats', 'allProviderStats',
            'allLokasiStats', 'allAksesStats', 'allVersiStats', 'allJenisAppStats'
        ));
    }

    /**
     * Website Health Check (scoped to user's OPD)
     */
    public function healthCheck(Request $request)
    {
        $opdId = $this->getOpdId();
        $opd = Opd::find($opdId);

        $skipDomains = ['play.google.com', 'apps.apple.com', 'drive.google.com', 'docs.google.com', 'dropbox.com', 'onedrive.live.com'];

        $webApps = $this->scopedQuery()
            ->with('opd')
            ->where('alamat_tautan', 'like', 'http%')
            ->where('jenis_aplikasi', 'like', '%web%')
            ->get()
            ->filter(function($app) use ($skipDomains) {
                $host = parse_url($app->alamat_tautan, PHP_URL_HOST);
                return !in_array($host, $skipDomains);
            });

        $totalCount = $webApps->count();

        // Load latest bulk check batch for this OPD
        $latestBatch = HealthCheckBatch::where('scope', (string) $opdId)
            ->latest()
            ->first();
        
        $bulkResults = collect();
        if ($latestBatch && $latestBatch->status === 'completed') {
            $bulkResults = HealthCheckResult::where('batch_id', $latestBatch->batch_id)
                ->orderBy('http_code')
                ->orderBy('nama_web_app')
                ->get();
        }

        return view('monitoring.health-check', compact('webApps', 'opd', 'totalCount', 'latestBatch', 'bulkResults'));
    }

    /**
     * Check single URL status (AJAX) - reuse same logic as admin
     */
    public function checkUrl(Request $request)
    {
        $url = $request->get('url');

        if (!$url) {
            return response()->json(['error' => 'URL required'], 400);
        }

        try {
            $startTime = microtime(true);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_NOBODY, true);

            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $responseTime = round((microtime(true) - $startTime) * 1000);
            $sslInfo = curl_getinfo($ch, CURLINFO_SSL_VERIFYRESULT);

            curl_close($ch);

            $status = 'offline';
            if ($httpCode >= 200 && $httpCode < 400) {
                $status = $responseTime > 2000 ? 'slow' : 'online';
            }

            return response()->json([
                'status' => $status,
                'http_code' => $httpCode,
                'response_time' => $responseTime,
                'ssl_valid' => $sslInfo === 0,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'offline',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Start bulk health check for user's OPD websites (dispatches queue job)
     */
    public function startBulkCheck(Request $request)
    {
        $opdId = $this->getOpdId();

        // Check if there's already a running batch for this OPD
        $running = HealthCheckBatch::where('scope', (string) $opdId)
            ->whereIn('status', ['running', 'pending'])
            ->first();
        
        if ($running) {
            return response()->json([
                'error' => 'Pengecekan sedang berjalan, tunggu selesai',
                'batch_id' => $running->batch_id,
                'status' => $running->status,
            ], 409);
        }

        $batchId = Str::uuid()->toString();
        
        HealthCheckBatch::create([
            'batch_id' => $batchId,
            'total' => 0,
            'completed' => 0,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'scope' => (string) $opdId,
        ]);

        // Dispatch job ke queue dengan OPD ID
        ProcessHealthCheckJob::dispatch($batchId, $opdId)->onQueue('health-check');

        return response()->json([
            'batch_id' => $batchId, 
            'message' => 'Pengecekan dimulai. Proses berjalan di background, refresh halaman untuk melihat progress.'
        ]);
    }

    /**
     * Get bulk check progress (polling endpoint)
     */
    public function getBulkProgress(string $batchId)
    {
        $batch = HealthCheckBatch::where('batch_id', $batchId)->first();
        
        if (!$batch) {
            return response()->json(['error' => 'Batch tidak ditemukan'], 404);
        }

        return response()->json([
            'batch_id'  => $batch->batch_id,
            'total'     => $batch->total,
            'completed' => $batch->completed,
            'status'    => $batch->status,
            'percent'   => $batch->progress_percent,
        ]);
    }

    /**
     * Get bulk check results
     */
    public function getBulkResults(string $batchId)
    {
        $results = HealthCheckResult::where('batch_id', $batchId)
            ->orderBy('http_code')
            ->orderBy('nama_web_app')
            ->get()
            ->map(function ($r) {
                return [
                    'nama_web_app' => $r->nama_web_app,
                    'opd_nama' => $r->opd_nama,
                    'alamat_tautan' => $r->alamat_tautan,
                    'http_code' => $r->http_code,
                    'http_label' => HealthCheckResult::httpCodeLabel($r->http_code),
                    'http_desc' => HealthCheckResult::httpCodeDescription($r->http_code),
                    'status' => $r->status,
                    'response_time_ms' => $r->response_time_ms,
                    'checked_at' => $r->checked_at,
                ];
            });

        return response()->json(['results' => $results, 'total' => $results->count()]);
    }

    /**
     * Export health check results to Excel
     */
    public function exportHealthCheck(string $batchId)
    {
        $batch = HealthCheckBatch::where('batch_id', $batchId)->first();
        if (!$batch) {
            return redirect()->back()->with('error', 'Batch tidak ditemukan');
        }

        $results = HealthCheckResult::where('batch_id', $batchId)
            ->orderBy('opd_nama')
            ->orderBy('nama_web_app')
            ->get();

        // Get user's OPD name
        $opdName = auth()->user()->opd->nama_opd ?? 'OPD';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Health Check');

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E40AF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D1D5DB']]],
        ];

        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'Laporan Cek Status Website - ' . $opdName);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'OPD: ' . $opdName . ' | Tanggal: ' . ($batch->created_at?->format('d M Y H:i') ?? '-'));
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setSize(10)->setItalic(true);

        $headers = ['No', 'Nama Aplikasi', 'OPD', 'URL', 'HTTP Code', 'Keterangan', 'Status', 'Response Time (ms)', 'Waktu Cek'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '4', $header);
            $col++;
        }
        $sheet->getStyle('A4:I4')->applyFromArray($headerStyle);
        $sheet->getRowDimension(4)->setRowHeight(25);

        $row = 5;
        foreach ($results as $i => $r) {
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, $r->nama_web_app);
            $sheet->setCellValue('C' . $row, $r->opd_nama);
            $sheet->setCellValue('D' . $row, $r->alamat_tautan);
            $sheet->setCellValue('E' . $row, $r->http_code ?: 0);
            $sheet->setCellValue('F' . $row, HealthCheckResult::httpCodeDescription($r->http_code));
            $sheet->setCellValue('G' . $row, ucfirst($r->status));
            $sheet->setCellValue('H' . $row, $r->response_time_ms);
            $sheet->setCellValue('I' . $row, $r->checked_at ?? '-');

            $rowColor = match($r->status) {
                'online' => 'DCFCE7',
                'slow' => 'FEF3C7',
                'offline' => 'FEE2E2',
                'error' => 'FEE2E2',
                default => 'F9FAFB',
            };
            $sheet->getStyle("A{$row}:I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($rowColor);
            $sheet->getStyle("A{$row}:I{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB('E5E7EB');

            $row++;
        }

        $row++;
        $onlineCount = $results->where('status', 'online')->count();
        $slowCount = $results->where('status', 'slow')->count();
        $offlineCount = $results->whereIn('status', ['offline', 'error'])->count();
        
        $sheet->setCellValue('A' . $row, 'RINGKASAN:');
        $sheet->setCellValue('B' . $row, "Total: {$results->count()} | Aktif: {$onlineCount} | Lambat: {$slowCount} | Tidak Aktif: {$offlineCount}");
        $sheet->mergeCells("B{$row}:I{$row}");
        $sheet->getStyle("A{$row}:I{$row}")->getFont()->setBold(true);

        foreach (range('A', 'I') as $c) {
            $sheet->getColumnDimension($c)->setAutoSize(true);
        }

        $filename = 'health-check-' . Str::slug($opdName) . '-' . now()->format('Y-m-d_His') . '.xlsx';
        $tempPath = storage_path('app/' . $filename);

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }

    /**
     * Get apps filtered by a specific field and value (for clickable stats, scoped to OPD)
     */
    public function getAppsByFilter(Request $request)
    {
        try {
            $field = $request->get('field');
            $value = $request->get('value', '');
            $opdId = $this->getOpdId();

            $allowedFields = [
                'jenis_aplikasi', 'framework', 'bahasa_pemrograman', 'dbms', 'arsitektur_sistem',
                'has_repository', 'git_repository', 'penyedia_repository',
                'lokasi_database', 'akses_database', 'versi_dbms',
                'daftar_library_package'
            ];

            if (!in_array($field, $allowedFields)) {
                return response()->json(['error' => 'Invalid field', 'apps' => [], 'total' => 0], 400);
            }

            $scope = $request->get('scope', 'opd');
        $query = WebApp::with('opd:id,nama_opd');
        if ($scope !== 'all') {
            $query->where('opd_id', $opdId);
        }

            if ($field === 'has_repository') {
                if ($value === 'ya') {
                    $query->where(function($q) {
                        $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
                    });
                } else {
                    $query->whereNull('penyedia_repository')->whereNull('git_repository');
                }
            } elseif (!empty($value)) {
                $baseValue = preg_replace('/\s+[\d\.x]+$/', '', trim($value));
                $query->whereRaw('LOWER(' . $field . ') LIKE ?', ['%' . strtolower($baseValue) . '%']);
            }

            $total = $query->count();

            $apps = (clone $query)
                ->orderBy('nama_web_app')
                ->limit(50)
                ->get()
                ->map(function($app) {
                    return [
                        'id' => $app->id,
                        'nama_aplikasi' => $app->nama_web_app,
                        'url_aplikasi' => $app->alamat_tautan,
                        'opd' => $app->opd ? ['nama_opd' => $app->opd->nama_opd] : null
                    ];
                });

            return response()->json([
                'apps' => $apps,
                'total' => $total,
                'field' => $field,
                'value' => $value
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'apps' => [],
                'total' => 0
            ], 500);
        }
    }



    /**
     * Get apps for a specific OPD (read-only modal detail)
     */
    public function getOpdApps(Opd $opd)
    {
        $apps = $opd->webApps()
            ->select('id', 'nama_web_app', 'alamat_tautan', 'created_at')
            ->orderBy('nama_web_app')
            ->get();

        return response()->json([
            'opd' => ['id' => $opd->id, 'nama_opd' => $opd->nama_opd],
            'apps' => $apps,
            'total' => $apps->count()
        ]);
    }

    /**
     * Get version breakdown for a framework or language (AJAX, global scope)
     */
    public function getVersionBreakdown(Request $request)
    {
        $field = $request->get('field');
        $value = $request->get('value', '');
        $scope = $request->get('scope', 'all');

        $allowedFields = ['framework', 'bahasa_pemrograman'];
        if (!in_array($field, $allowedFields)) {
            return response()->json(['error' => 'Invalid field', 'versions' => []], 400);
        }

        $query = WebApp::whereRaw('LOWER(' . $field . ') LIKE ?', ['%' . strtolower($value) . '%']);
        if ($scope === 'opd') {
            $query->where('opd_id', $this->getOpdId());
        }
        $rows = $query->pluck($field);

        $versionCounts = [];
        $baseLower = strtolower($value);

        foreach ($rows as $rawValue) {
            $parts = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $rawValue);
            foreach ($parts as $part) {
                $part = trim($part);
                if (!$part) continue;
                if (stripos($part, $value) !== false) {
                    $versionCounts[$part] = ($versionCounts[$part] ?? 0) + 1;
                }
            }
        }

        arsort($versionCounts);

        $versions = collect($versionCounts)->map(fn($total, $name) => [
            'value' => $name,
            'total' => $total,
        ])->values();

        return response()->json([
            'field' => $field,
            'base' => $value,
            'versions' => $versions,
            'total' => $versions->sum('total'),
        ]);
    }

    /**
     * Get DBMS version breakdown (AJAX, global scope)
     */
    public function getDbmsVersionBreakdown(Request $request)
    {
        $dbmsName = $request->get('value', '');
        $scope = $request->get('scope', 'all');

        $query = WebApp::select('dbms', 'versi_dbms')
            ->whereRaw('LOWER(dbms) LIKE ?', ['%' . strtolower($dbmsName) . '%']);
        if ($scope === 'opd') {
            $query->where('opd_id', $this->getOpdId());
        }
        $rows = $query->get();

        $versionCounts = [];
        foreach ($rows as $row) {
            $version = trim($row->versi_dbms ?? '');
            $label = $version ? $row->dbms . ' ' . $version : $row->dbms . ' (versi tidak diketahui)';
            $versionCounts[$label] = ($versionCounts[$label] ?? 0) + 1;
        }

        arsort($versionCounts);

        $versions = collect($versionCounts)->map(fn($total, $name) => [
            'value' => $name,
            'total' => $total,
        ])->values();

        return response()->json([
            'field' => 'dbms',
            'base' => $dbmsName,
            'versions' => $versions,
            'total' => $versions->sum('total'),
        ]);
    }

    /**
     * Get library version breakdown (AJAX)
     */
    public function getLibraryVersionBreakdown(Request $request)
    {
        $libName = $request->get('value', '');
        $scope = $request->get('scope', 'all');

        $query = WebApp::where('daftar_library_package', 'LIKE', '%' . $libName . '%');
        if ($scope === 'opd') {
            $query->where('opd_id', $this->getOpdId());
        }
        $rows = $query->pluck('daftar_library_package');

        $versionCounts = [];

        foreach ($rows as $rawValue) {
            $items = array_map('trim', explode(',', $rawValue));
            foreach ($items as $item) {
                if (!$item) continue;
                if (stripos($item, $libName) !== false) {
                    $versionCounts[$item] = ($versionCounts[$item] ?? 0) + 1;
                }
            }
        }

        arsort($versionCounts);

        $versions = collect($versionCounts)->map(fn($total, $name) => [
            'value' => $name,
            'total' => $total,
        ])->values();

        return response()->json([
            'field' => 'daftar_library_package',
            'base' => $libName,
            'versions' => $versions,
            'total' => $versions->sum('total'),
        ]);
    }

    /**
     * Export current user's OPD applications to Excel
     */
    public function exportOpdApps()
    {
        $opd = auth()->user()->opd;
        $opdName = $opd->nama_opd ?? 'OPD';
        $apps = WebApp::where('opd_id', $opd->id)->orderBy('nama_web_app')->get();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Aplikasi');

        $lastCol = 'Q'; // 17 columns (no OPD column for single-OPD export)

        // ROW 1: Main Title
        $sheet->mergeCells("A1:{$lastCol}1");
        $sheet->setCellValue('A1', 'LAPORAN DATA APLIKASI WEB');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => '1E3A5F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E8F0FE']],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(35);

        // ROW 2: OPD Name
        $sheet->mergeCells("A2:{$lastCol}2");
        $sheet->setCellValue('A2', $opdName);
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '1E40AF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E8F0FE']],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(22);

        // ROW 3: Date & Stats
        $sheet->mergeCells("A3:{$lastCol}3");
        $sheet->setCellValue('A3', 'Dicetak: ' . now()->format('d M Y, H:i') . '  •  Total: ' . $apps->count() . ' aplikasi');
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['size' => 9, 'italic' => true, 'color' => ['rgb' => '64748B']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F8FAFC']],
            'borders' => ['bottom' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => '1E40AF']]],
        ]);
        $sheet->getRowDimension(3)->setRowHeight(20);

        // ROW 4: Category Group Headers
        $catStyle = fn($rgb) => [
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $rgb]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ];

        $sheet->mergeCells('A4:E4');
        $sheet->setCellValue('A4', '📋 INFORMASI UMUM');
        $sheet->getStyle('A4:E4')->applyFromArray($catStyle('1E40AF'));

        $sheet->mergeCells('F4:K4');
        $sheet->setCellValue('F4', '⚙️ STACK TEKNOLOGI');
        $sheet->getStyle('F4:K4')->applyFromArray($catStyle('7C3AED'));

        $sheet->mergeCells('L4:P4');
        $sheet->setCellValue('L4', '💾 REPOSITORY & BACKUP');
        $sheet->getStyle('L4:P4')->applyFromArray($catStyle('0D9488'));

        $sheet->setCellValue('Q4', '🗄️ DATABASE');
        $sheet->getStyle('Q4')->applyFromArray($catStyle('D97706'));

        $sheet->getRowDimension(4)->setRowHeight(22);

        // ROW 5: Column Headers
        $headers = [
            'A' => 'No', 'B' => 'Nama Aplikasi', 'C' => 'Deskripsi', 'D' => 'URL', 'E' => 'Jenis',
            'F' => 'Bahasa', 'G' => 'Framework', 'H' => 'Arsitektur', 'I' => 'DBMS', 'J' => 'Versi DBMS',
            'K' => 'Library / Package', 'L' => 'Repository', 'M' => 'Penyedia Repo',
            'N' => 'Lokasi DB', 'O' => 'Akses DB', 'P' => 'Backup Source Code', 'Q' => 'Backup Database',
        ];

        foreach ($headers as $col => $label) {
            $sheet->setCellValue($col . '5', $label);
        }

        $colHeaderBase = [
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ];

        $colColors = [
            'A:E' => '3B82F6', 'F:K' => '8B5CF6', 'L:P' => '14B8A6', 'Q:Q' => 'F59E0B',
        ];

        foreach ($colColors as $range => $rgb) {
            [$start, $end] = explode(':', $range);
            $style = $colHeaderBase;
            $style['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $rgb]];
            $sheet->getStyle("{$start}5:{$end}5")->applyFromArray($style);
        }
        $sheet->getRowDimension(5)->setRowHeight(28);

        // Column widths
        $widths = [
            'A' => 5, 'B' => 30, 'C' => 35, 'D' => 35, 'E' => 14,
            'F' => 18, 'G' => 18, 'H' => 14, 'I' => 14, 'J' => 12, 'K' => 25,
            'L' => 14, 'M' => 16, 'N' => 14, 'O' => 14, 'P' => 18, 'Q' => 18,
        ];
        foreach ($widths as $c => $w) {
            $sheet->getColumnDimension($c)->setWidth($w);
        }

        $sheet->freezePane('B6');

        // DATA ROWS
        $row = 6;
        $rowColors = ['F0F7FF', 'FFFFFF'];
        $dataStyle = [
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E2E8F0']]],
        ];

        foreach ($apps as $i => $app) {
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, $app->nama_web_app);
            $sheet->setCellValue('C' . $row, $app->deskripsi_singkat);
            $sheet->setCellValue('D' . $row, $app->alamat_tautan);
            $sheet->setCellValue('E' . $row, $app->jenis_aplikasi);
            $sheet->setCellValue('F' . $row, $app->bahasa_pemrograman);
            $sheet->setCellValue('G' . $row, $app->framework);
            $sheet->setCellValue('H' . $row, $app->arsitektur_sistem);
            $sheet->setCellValue('I' . $row, $app->dbms);
            $sheet->setCellValue('J' . $row, $app->versi_dbms);
            $sheet->setCellValue('K' . $row, $app->daftar_library_package);
            $sheet->setCellValue('L' . $row, $app->git_repository);
            $sheet->setCellValue('M' . $row, $app->penyedia_repository);
            $sheet->setCellValue('N' . $row, $app->lokasi_database);
            $sheet->setCellValue('O' . $row, $app->akses_database);
            $sheet->setCellValue('P' . $row, $app->metode_backup_source_code);
            $sheet->setCellValue('Q' . $row, $app->metode_backup_database);

            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->applyFromArray($dataStyle);
            $sheet->getStyle("A{$row}:{$lastCol}{$row}")->getFill()
                ->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($rowColors[$i % 2]);
            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            if ($app->alamat_tautan) {
                $sheet->getCell("D{$row}")->getHyperlink()->setUrl($app->alamat_tautan);
                $sheet->getStyle("D{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('3B82F6'))->setUnderline(true);
            }

            $row++;
        }

        // SUMMARY
        $row++;

        // Summary banner
        $sheet->mergeCells("A{$row}:{$lastCol}{$row}");
        $sheet->setCellValue("A{$row}", '📊 RINGKASAN LAPORAN');
        $sheet->getStyle("A{$row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E293B']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(30);
        $row++;

        // Card labels row
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", '📋  TOTAL APLIKASI');
        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '1E40AF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DBEAFE']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BFDBFE']]],
        ]);

        $sheet->mergeCells("E{$row}:I{$row}");
        $sheet->setCellValue("E{$row}", '🏢  OPD');
        $sheet->getStyle("E{$row}:I{$row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '065F46']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D1FAE5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'A7F3D0']]],
        ]);

        $sheet->mergeCells("J{$row}:{$lastCol}{$row}");
        $sheet->getStyle("J{$row}:{$lastCol}{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
        $sheet->getRowDimension($row)->setRowHeight(22);
        $row++;

        // Big values row
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", $apps->count());
        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 28, 'color' => ['rgb' => '1E40AF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EFF6FF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'BFDBFE']]],
        ]);

        $sheet->mergeCells("E{$row}:I{$row}");
        $sheet->setCellValue("E{$row}", $opdName);
        $sheet->getStyle("E{$row}:I{$row}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '065F46']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECFDF5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'A7F3D0']]],
        ]);

        $sheet->mergeCells("J{$row}:{$lastCol}{$row}");
        $sheet->getStyle("J{$row}:{$lastCol}{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
        $sheet->getRowDimension($row)->setRowHeight(45);
        $row++;

        // Subtitles
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'Aplikasi terdaftar');
        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
            'font' => ['size' => 9, 'italic' => true, 'color' => ['rgb' => '64748B']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EFF6FF']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['bottom' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => '3B82F6']]],
        ]);

        $sheet->mergeCells("E{$row}:I{$row}");
        $sheet->setCellValue("E{$row}", 'Organisasi perangkat daerah');
        $sheet->getStyle("E{$row}:I{$row}")->applyFromArray([
            'font' => ['size' => 9, 'italic' => true, 'color' => ['rgb' => '64748B']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'ECFDF5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['bottom' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => '10B981']]],
        ]);

        $sheet->mergeCells("J{$row}:{$lastCol}{$row}");
        $sheet->getStyle("J{$row}:{$lastCol}{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
        $sheet->getRowDimension($row)->setRowHeight(18);

        // Page Setup
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->setAutoFilter("A5:{$lastCol}5");

        // Generate
        $filename = 'data-aplikasi-' . Str::slug($opdName) . '-' . now()->format('Y-m-d_His') . '.xlsx';
        $tempPath = storage_path('app/' . $filename);

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }
}
