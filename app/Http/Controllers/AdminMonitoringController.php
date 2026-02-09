<?php

namespace App\Http\Controllers;

use App\Models\WebApp;
use App\Models\User;
use App\Models\Opd;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMonitoringController extends Controller
{
    /**
     * Monitoring Overview Dashboard (merged with Teknologi)
     */
    public function index(Request $request)
    {
        // Handle filter for inline detail display
        $filterField = $request->get('filter_field');
        $filterValue = $request->get('filter_value');
        $filteredApps = collect();
        
        if ($filterField && $filterValue !== null) {
            $query = WebApp::with('opd:id,nama_opd');
            
            if ($filterField === 'has_repository') {
                if ($filterValue === 'ya') {
                    $query->where('has_repository', 'ya');
                } else {
                    $query->where(function($q) {
                        $q->whereNull('has_repository')
                          ->orWhere('has_repository', '!=', 'ya');
                    });
                }
            } else {
                $query->where($filterField, 'LIKE', '%' . $filterValue . '%');
            }
            
            $filteredApps = $query->orderBy('nama_aplikasi')->limit(100)->get();
        }

        // Summary stats for overview
        $stats = [
            'total_apps' => WebApp::count(),
            'total_opds' => Opd::count(),
            'total_users' => User::count(),
            'apps_with_repo' => WebApp::where('has_repository', 'ya')->count(),
        ];

        // Known frameworks for smart extraction (mega expanded list)
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
        WebApp::whereNotNull('framework')->pluck('framework')->each(function ($value) use (&$frameworkCounts, $knownFrameworks) {
            // First try standard separators
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                
                // Check if item contains known framework - extract it with version
                $found = false;
                foreach ($knownFrameworks as $fw) {
                    if (preg_match('/\b(' . preg_quote($fw, '/') . ')\s*([\d\.]+)?\s*(.*)/i', $item, $matches)) {
                        $name = ucfirst(strtolower($matches[1]));
                        // Don't include version - just the base name
                        $frameworkCounts[$name] = ($frameworkCounts[$name] ?? 0) + 1;
                        $found = true;
                        
                        // Check remaining text for another framework
                        $remaining = trim($matches[3] ?? '');
                        if ($remaining) {
                            foreach ($knownFrameworks as $fw2) {
                                if (preg_match('/\b(' . preg_quote($fw2, '/') . ')\s*([\d\.]+)?/i', $remaining, $m2)) {
                                    $name2 = ucfirst(strtolower($m2[1]));
                                    // Don't include version
                                    $frameworkCounts[$name2] = ($frameworkCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                
                // If no known framework found, keep as-is
                if (!$found && $item) {
                    $frameworkCounts[$item] = ($frameworkCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($frameworkCounts);
        $topFrameworks = collect(array_slice($frameworkCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['framework' => $name, 'total' => $total]);

        // Known programming languages for smart extraction (mega expanded list)
        $knownLanguages = [
            // Web Languages
            'php', 'php5', 'php7', 'php8', 'javascript', 'js', 'ecmascript', 'es6', 'es2015', 'es2020', 'typescript', 'ts', 'html', 'html4', 'html5', 'xhtml', 'css', 'css2', 'css3', 'sass', 'scss', 'less', 'stylus', 'postcss',
            // General Purpose - Popular (removed single-letter 'v', 'r', 'c', 'd' to avoid false matches with words like 'versi')
            'python', 'python2', 'python3', 'java', 'c#', 'csharp', 'c-sharp', 'c++', 'cpp', 'cplusplus', 'go', 'golang', 'rust', 'ruby', 'swift', 'kotlin', 'dart', 'scala', 'groovy', 'clojure', 'elixir', 'erlang', 'haskell', 'f#', 'fsharp', 'ocaml', 'nim', 'crystal', 'zig', 'vlang', 'dlang', 'ada', 'modula', 'oberon',
            // Mobile Development
            'objective-c', 'objc', 'objective c', 'swift', 'kotlin', 'dart', 'java', 'c#',
            // Scripting Languages
            'perl', 'perl5', 'perl6', 'raku', 'lua', 'luajit', 'shell', 'sh', 'bash', 'zsh', 'fish', 'powershell', 'ps1', 'batch', 'bat', 'cmd', 'vbscript', 'vbs', 'applescript', 'osascript', 'awk', 'sed', 'grep', 'tcl', 'tk', 'expect', 'autohotkey', 'ahk', 'autoit',
            // Data Science & Scientific (removed single-letter 'r' to avoid false matches)
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
            'gdscript', 'godot', 'unrealscript', 'uscript', 'blueprints', 'blueprint', 'unityscript', 'boo', 'angelscript', 'squirrel', 'haxe', 'openfl', 'flixel', 'game maker', 'gml', 'rpg maker', 'ruby', 'renpy', 'ren\'py', 'inform', 'twine', 'ink', 'choicescript',
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
        WebApp::whereNotNull('bahasa_pemrograman')->pluck('bahasa_pemrograman')->each(function ($value) use (&$bahasaCounts, $knownLanguages) {
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
                        // Don't include version - just the base name
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
                                    // Don't include version
                                    $bahasaCounts[$name2] = ($bahasaCounts[$name2] ?? 0) + 1;
                                }
                            }
                        }
                        break;
                    }
                }
                
                if (!$found && $item) {
                    $bahasaCounts[$item] = ($bahasaCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($bahasaCounts);
        $bahasaStats = collect(array_slice($bahasaCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['bahasa_pemrograman' => $name, 'total' => $total]);

        // DBMS stats (also split)
        $dbmsCounts = [];
        WebApp::whereNotNull('dbms')->pluck('dbms')->each(function ($value) use (&$dbmsCounts) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if ($item) {
                    $dbmsCounts[$item] = ($dbmsCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($dbmsCounts);
        $dbmsStats = collect(array_slice($dbmsCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['dbms' => $name, 'total' => $total]);

        // Top 5 OPDs by app count
        $topOpds = Opd::withCount('webApps')
            ->orderByDesc('web_apps_count')
            ->limit(5)
            ->get();

        // Architecture distribution
        $arsitekturStats = WebApp::select('arsitektur_sistem', DB::raw('count(*) as total'))
            ->groupBy('arsitektur_sistem')
            ->get();

        // Repository Stats (merged from repository page)
        $punyaRepo = WebApp::where('has_repository', 'ya')->count();
        $tidakRepo = WebApp::where(function($q) {
            $q->whereNull('has_repository')
              ->orWhere('has_repository', '!=', 'ya');
        })->count();
        $hasRepoStats = collect([
            (object)['has_repository' => 'ya', 'total' => $punyaRepo],
            (object)['has_repository' => 'tidak', 'total' => $tidakRepo],
        ]);
        $gitTypeStats = WebApp::select('git_repository', DB::raw('count(*) as total'))
            ->whereNotNull('git_repository')
            ->groupBy('git_repository')
            ->get();
        $providerStats = WebApp::select('penyedia_repository', DB::raw('count(*) as total'))
            ->whereNotNull('penyedia_repository')
            ->groupBy('penyedia_repository')
            ->orderByDesc('total')
            ->get();

        // Database Stats (merged from database page)
        $lokasiStats = WebApp::select('lokasi_database', DB::raw('count(*) as total'))
            ->groupBy('lokasi_database')
            ->get();
        $aksesStats = WebApp::select('akses_database', DB::raw('count(*) as total'))
            ->groupBy('akses_database')
            ->get();
        $versiStats = WebApp::select('versi_dbms', DB::raw('count(*) as total'))
            ->groupBy('versi_dbms')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.monitoring.index', compact(
            'stats', 'topFrameworks', 'bahasaStats', 'dbmsStats', 'topOpds', 'arsitekturStats',
            'hasRepoStats', 'gitTypeStats', 'providerStats',
            'lokasiStats', 'aksesStats', 'versiStats',
            'filteredApps', 'filterField', 'filterValue'
        ));
    }

    /**
     * Statistik Teknologi
     */
    public function teknologi(Request $request)
    {
        $filter = $request->get('filter', 'framework');
        
        // Framework stats
        $frameworkStats = WebApp::select('framework', DB::raw('count(*) as total'))
            ->groupBy('framework')
            ->orderByDesc('total')
            ->get();

        // Bahasa Pemrograman stats (extract from text field)
        $bahasaStats = WebApp::select('bahasa_pemrograman', DB::raw('count(*) as total'))
            ->groupBy('bahasa_pemrograman')
            ->orderByDesc('total')
            ->get();

        // DBMS stats
        $dbmsStats = WebApp::select('dbms', DB::raw('count(*) as total'))
            ->groupBy('dbms')
            ->orderByDesc('total')
            ->get();

        // Arsitektur stats
        $arsitekturStats = WebApp::select('arsitektur_sistem', DB::raw('count(*) as total'))
            ->groupBy('arsitektur_sistem')
            ->get();

        // For drill-down
        $selectedValue = $request->get('value');
        $drilldownData = null;
        
        if ($selectedValue) {
            $drilldownData = WebApp::with(['opd', 'user'])
                ->where($filter, $selectedValue)
                ->paginate(10);
        }

        return view('admin.monitoring.teknologi', compact(
            'frameworkStats', 'bahasaStats', 'dbmsStats', 'arsitekturStats', 
            'filter', 'selectedValue', 'drilldownData'
        ));
    }

    /**
     * Statistik Repository
     */
    public function repository(Request $request)
    {
        // Has repository
        $hasRepoStats = WebApp::select('has_repository', DB::raw('count(*) as total'))
            ->groupBy('has_repository')
            ->get();

        // Git type (public/private)
        $gitTypeStats = WebApp::select('git_repository', DB::raw('count(*) as total'))
            ->whereNotNull('git_repository')
            ->groupBy('git_repository')
            ->get();

        // Provider
        $providerStats = WebApp::select('penyedia_repository', DB::raw('count(*) as total'))
            ->whereNotNull('penyedia_repository')
            ->groupBy('penyedia_repository')
            ->orderByDesc('total')
            ->get();

        return view('admin.monitoring.repository', compact('hasRepoStats', 'gitTypeStats', 'providerStats'));
    }

    /**
     * Statistik Database
     */
    public function database(Request $request)
    {
        // Location stats
        $lokasiStats = WebApp::select('lokasi_database', DB::raw('count(*) as total'))
            ->groupBy('lokasi_database')
            ->get();

        // Access stats
        $aksesStats = WebApp::select('akses_database', DB::raw('count(*) as total'))
            ->groupBy('akses_database')
            ->get();

        // DBMS stats
        $dbmsStats = WebApp::select('dbms', DB::raw('count(*) as total'))
            ->groupBy('dbms')
            ->orderByDesc('total')
            ->get();

        // Version stats
        $versiStats = WebApp::select('versi_dbms', DB::raw('count(*) as total'))
            ->groupBy('versi_dbms')
            ->orderByDesc('total')
            ->get();

        return view('admin.monitoring.database', compact('lokasiStats', 'aksesStats', 'dbmsStats', 'versiStats'));
    }

    /**
     * Statistik OPD
     */
    public function opd(Request $request)
    {
        // All OPDs with app count
        $opdStats = Opd::withCount('webApps')
            ->orderByDesc('web_apps_count')
            ->get();

        // OPDs without apps
        $emptyOpds = Opd::withCount('webApps')
            ->having('web_apps_count', '=', 0)
            ->get();

        // Average apps per OPD
        $avgAppsPerOpd = round(WebApp::count() / max(Opd::count(), 1), 1);

        // Top 10 OPDs
        $topOpds = $opdStats->take(10);

        return view('admin.monitoring.opd', compact('opdStats', 'emptyOpds', 'avgAppsPerOpd', 'topOpds'));
    }

    /**
     * Statistik Backup
     */
    public function backup(Request $request)
    {
        // Backup source code methods
        $backupCodeStats = WebApp::select('metode_backup_source_code', DB::raw('count(*) as total'))
            ->groupBy('metode_backup_source_code')
            ->orderByDesc('total')
            ->get();

        // Backup database methods
        $backupDbStats = WebApp::select('metode_backup_database', DB::raw('count(*) as total'))
            ->groupBy('metode_backup_database')
            ->orderByDesc('total')
            ->get();

        // Backup asset methods
        $backupAssetStats = WebApp::select('metode_backup_asset', DB::raw('count(*) as total'))
            ->groupBy('metode_backup_asset')
            ->orderByDesc('total')
            ->get();

        return view('admin.monitoring.backup', compact('backupCodeStats', 'backupDbStats', 'backupAssetStats'));
    }

    /**
     * Activity Log
     */
    public function activityLog(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.monitoring.activity-log', compact('logs'));
    }

    /**
     * User Analytics
     */
    public function userAnalytics(Request $request)
    {
        // Users with last login
        $users = User::with(['role', 'opd'])
            ->whereHas('role', fn($q) => $q->where('name', 'user'))
            ->orderByDesc('last_login_at')
            ->get();

        // Active users (logged in last 30 days)
        $activeUsers = User::whereNotNull('last_login_at')
            ->where('last_login_at', '>=', now()->subDays(30))
            ->count();

        // Inactive users
        $inactiveUsers = User::where(function($q) {
            $q->whereNull('last_login_at')
              ->orWhere('last_login_at', '<', now()->subDays(30));
        })->count();

        // Users per OPD
        $usersPerOpd = Opd::withCount('users')
            ->orderByDesc('users_count')
            ->get();

        return view('admin.monitoring.user-analytics', compact('users', 'activeUsers', 'inactiveUsers', 'usersPerOpd'));
    }

    /**
     * Laporan & Export
     */
    public function laporan(Request $request)
    {
        $opds = Opd::orderBy('nama_opd')->get();
        
        return view('admin.monitoring.laporan', compact('opds'));
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $query = WebApp::with(['opd', 'user']);
        
        if ($request->filled('opd_id')) {
            $query->where('opd_id', $request->opd_id);
        }
        
        $webApps = $query->get();
        $opd = $request->filled('opd_id') ? Opd::find($request->opd_id) : null;
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.monitoring.pdf-report', compact('webApps', 'opd'));
        
        $filename = $opd ? 'laporan-' . \Str::slug($opd->nama_opd) . '.pdf' : 'laporan-semua-opd.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        // Simple CSV export
        $query = WebApp::with(['opd', 'user']);
        
        if ($request->filled('opd_id')) {
            $query->where('opd_id', $request->opd_id);
        }
        
        $webApps = $query->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan-aplikasi.csv"',
        ];
        
        $callback = function() use ($webApps) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['No', 'Nama Aplikasi', 'OPD', 'Alamat Tautan', 'Framework', 'DBMS', 'Repository']);
            
            // Data rows
            $no = 1;
            foreach ($webApps as $app) {
                fputcsv($file, [
                    $no++,
                    $app->nama_web_app,
                    $app->opd->nama_opd ?? '-',
                    $app->alamat_tautan,
                    $app->framework,
                    $app->dbms,
                    $app->has_repository,
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Website Health Check
     */
    public function healthCheck(Request $request)
    {
        // Get all OPDs for dropdown
        $opds = Opd::orderBy('nama_opd')->get();
        
        // Skip domains
        $skipDomains = ['play.google.com', 'apps.apple.com', 'drive.google.com', 'docs.google.com', 'dropbox.com', 'onedrive.live.com'];
        
        // Get total count
        $totalCount = WebApp::where('alamat_tautan', 'like', 'http%')->count();
        
        // Get web apps filtered by selected OPD
        $selectedOpd = $request->opd_id;
        $webApps = collect();
        
        if ($selectedOpd) {
            $webApps = WebApp::with('opd')
                ->where('opd_id', $selectedOpd)
                ->where('alamat_tautan', 'like', 'http%')
                ->get()
                ->filter(function($app) use ($skipDomains) {
                    $host = parse_url($app->alamat_tautan, PHP_URL_HOST);
                    return !in_array($host, $skipDomains);
                });
        }

        return view('admin.monitoring.health-check', compact('webApps', 'opds', 'totalCount', 'selectedOpd'));
    }

    /**
     * Check single URL status (AJAX)
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
            curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Reduced from 10 to 3 seconds
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); // Connection timeout 2 seconds
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
     * Get apps filtered by a specific field and value (for clickable stats)
     */
    public function getAppsByFilter(Request $request)
    {
        try {
            $field = $request->get('field');
            $value = $request->get('value', '');

            $allowedFields = [
                'framework', 'bahasa_pemrograman', 'dbms', 'arsitektur_sistem',
                'has_repository', 'git_repository', 'penyedia_repository',
                'lokasi_database', 'akses_database', 'versi_dbms'
            ];

            if (!in_array($field, $allowedFields)) {
                return response()->json(['error' => 'Invalid field', 'apps' => [], 'total' => 0], 400);
            }

            $query = WebApp::with('opd:id,nama_opd');

            // Special handling for has_repository
            if ($field === 'has_repository') {
                if ($value === 'ya') {
                    $query->where('has_repository', 'ya');
                } else {
                    $query->where(function($q) {
                        $q->whereNull('has_repository')
                          ->orWhere('has_repository', '!=', 'ya');
                    });
                }
            } elseif (!empty($value)) {
                // Extract base name (remove version numbers like "10", "4.x", etc)
                $baseValue = preg_replace('/\s+[\d\.x]+$/', '', trim($value));
                // Use case-insensitive search
                $query->whereRaw('LOWER(' . $field . ') LIKE ?', ['%' . strtolower($baseValue) . '%']);
            }

            $total = $query->count();
            
            $apps = (clone $query)
                ->orderBy('nama_aplikasi')
                ->limit(50)
                ->get()
                ->map(function($app) {
                    return [
                        'id' => $app->id,
                        'nama_aplikasi' => $app->nama_aplikasi,
                        'url_aplikasi' => $app->url_aplikasi,
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
}
