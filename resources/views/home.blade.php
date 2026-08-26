<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Registro UNSJ: una nueva forma de conectar, aprender y avanzar.">
		<title>Registro UNSJ | Tu próximo capítulo empieza hoy</title>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="bg-[#101313] font-sans text-stone-100 antialiased">
		<main class="relative isolate overflow-hidden">
			<div class="pointer-events-none absolute inset-0 -z-10 bg-[#101313]"></div>
			<div class="pointer-events-none absolute -right-40 -top-48 -z-10 h-[34rem] w-[34rem] rounded-full bg-[#d6f35b]/10 blur-3xl"></div>
			<div class="pointer-events-none absolute left-[-12rem] top-[34rem] -z-10 h-[28rem] w-[28rem] rounded-full bg-[#e97b57]/10 blur-3xl"></div>

			<nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-7 lg:px-10" aria-label="Navegación principal">
				<a href="{{ route('home') }}" class="flex items-center gap-3 text-sm font-bold uppercase tracking-[0.2em] text-stone-100">
					<span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#d6f35b] text-lg font-black text-[#101313]">R</span>
					Registro <span class="hidden text-stone-500 sm:inline">/ UNSJ</span>
				</a>
				<div class="hidden items-center gap-8 text-sm text-stone-400 md:flex">
					<a href="#manifiesto" class="transition hover:text-[#d6f35b]">Manifiesto</a>
					<a href="#experiencia" class="transition hover:text-[#d6f35b]">Experiencia</a>
					<a href="#comunidad" class="transition hover:text-[#d6f35b]">Comunidad</a>
				</div>
				<a href="{{ route('login') }}" class="group flex items-center gap-2 rounded-full border border-stone-700 px-4 py-2 text-sm font-semibold transition hover:border-[#d6f35b] hover:text-[#d6f35b]">
					Ingresar
					<span class="transition group-hover:translate-x-1">-&gt;</span>
				</a>
			</nav>

			<section class="mx-auto grid max-w-7xl gap-16 px-6 pb-24 pt-16 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:px-10 lg:pb-32 lg:pt-20">
				<div class="max-w-3xl">
					<p class="mb-7 flex items-center gap-3 text-xs font-bold uppercase tracking-[0.32em] text-[#d6f35b]">
						<span class="h-px w-10 bg-[#d6f35b]"></span>
						Universidad Nacional de San Juan
					</p>
					<h1 class="max-w-4xl text-6xl font-black leading-[0.9] tracking-[-0.05em] text-stone-100 sm:text-8xl lg:text-[8.5rem]">
						Tu próximo<br>
						<span class="text-[#d6f35b]">capítulo</span><br>
						empieza hoy.
					</h1>
					<p class="mt-9 max-w-lg text-lg leading-8 text-stone-400">
						Un espacio para convertir tus ideas en movimiento. Encontrá oportunidades, conectá con tu comunidad y hacé que tu paso por la UNSJ deje huella.
					</p>
					<div class="mt-10 flex flex-col items-start gap-4 sm:flex-row sm:items-center">
						<a href="{{ route('register') }}" class="group inline-flex items-center gap-5 rounded-full bg-[#d6f35b] px-6 py-4 font-bold text-[#101313] transition hover:bg-white">
							Crear mi registro
							<span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#101313] text-[#d6f35b] transition group-hover:translate-x-1">-&gt;</span>
						</a>
						<a href="#experiencia" class="px-4 py-3 text-sm font-semibold text-stone-300 underline decoration-stone-600 underline-offset-8 transition hover:text-[#d6f35b]">Explorar la experiencia</a>
					</div>
				</div>

				<div class="relative mx-auto w-full max-w-xl lg:ml-auto" id="experiencia">
					<div class="relative aspect-[0.86] overflow-hidden rounded-[2rem] bg-[#d6f35b] p-3 shadow-2xl shadow-black/30">
						<div class="relative flex h-full flex-col justify-between overflow-hidden rounded-[1.5rem] bg-[#e97b57] p-7 text-[#101313] sm:p-10">
							<div class="absolute -right-16 -top-16 h-64 w-64 rounded-full border-[3rem] border-[#101313]/10"></div>
							<div class="absolute bottom-10 right-8 h-24 w-24 rounded-full bg-[#d6f35b]"></div>
							<div class="relative flex items-center justify-between text-xs font-black uppercase tracking-[0.2em]">
								<span>Registro / 01</span>
								<span>2026</span>
							</div>
							<div class="relative">
								<p class="mb-4 text-sm font-bold uppercase tracking-[0.25em]">La universidad que</p>
								<p class="max-w-xs text-5xl font-black leading-[0.9] tracking-[-0.05em] sm:text-7xl">te mueve.</p>
							</div>
							<div class="relative flex items-end justify-between border-t border-[#101313]/30 pt-5 text-sm font-bold">
								<span>San Juan, Argentina</span>
								<span class="text-3xl">↗</span>
							</div>
						</div>
					</div>
					<div class="absolute -bottom-7 -left-5 hidden rounded-2xl border border-stone-700 bg-[#181c1b] p-4 shadow-xl sm:block">
						<div class="mb-3 flex -space-x-2">
							<span class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-[#181c1b] bg-[#b6d4ef] text-xs font-bold text-[#101313]">LM</span>
							<span class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-[#181c1b] bg-[#f5ca84] text-xs font-bold text-[#101313]">SC</span>
							<span class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-[#181c1b] bg-[#d6f35b] text-xs font-bold text-[#101313]">+</span>
						</div>
						<p class="text-xs font-semibold text-stone-300">Más de 12.000 historias<br><span class="text-stone-500">forman parte de Registro</span></p>
					</div>
				</div>
			</section>

			<section id="manifiesto" class="border-y border-stone-800/80 bg-[#181c1b]">
				<div class="mx-auto grid max-w-7xl gap-10 px-6 py-16 lg:grid-cols-[0.8fr_1.2fr] lg:px-10 lg:py-20">
					<p class="text-sm font-bold uppercase tracking-[0.25em] text-[#e97b57]">Nuestro manifiesto</p>
					<div>
						<h2 class="max-w-3xl text-3xl font-bold leading-tight tracking-tight text-stone-100 sm:text-5xl">No venís solamente a estudiar. Venís a encontrar todo lo que podés llegar a ser.</h2>
						<div class="mt-10 grid gap-8 border-t border-stone-700 pt-8 sm:grid-cols-3">
							<div><p class="text-4xl font-black text-[#d6f35b]">01</p><p class="mt-3 text-sm leading-6 text-stone-400">Descubrí tu camino</p></div>
							<div><p class="text-4xl font-black text-[#e97b57]">02</p><p class="mt-3 text-sm leading-6 text-stone-400">Conectá con otros</p></div>
							<div><p class="text-4xl font-black text-[#b6d4ef]">03</p><p class="mt-3 text-sm leading-6 text-stone-400">Dejá tu marca</p></div>
						</div>
					</div>
				</div>
			</section>

			<section id="comunidad" class="mx-auto flex max-w-7xl flex-col gap-8 px-6 py-16 sm:flex-row sm:items-end sm:justify-between lg:px-10 lg:py-24">
				<div><p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-[#d6f35b]">¿Listo para empezar?</p><h2 class="max-w-xl text-4xl font-black tracking-tight sm:text-6xl">Hacé lugar para lo que viene.</h2></div>
				<a href="{{ route('register') }}" class="inline-flex shrink-0 items-center justify-center rounded-full border border-stone-600 px-6 py-4 text-sm font-bold transition hover:border-[#d6f35b] hover:bg-[#d6f35b] hover:text-[#101313]">Sumarme a Registro <span class="ml-4 text-lg">↗</span></a>
			</section>
		</main>
		<footer class="border-t border-stone-800 px-6 py-7 lg:px-10"><div class="mx-auto flex max-w-7xl flex-col gap-3 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between"><span>© {{ date('Y') }} Registro UNSJ</span><span>Hecho para quienes están por hacer.</span></div></footer>
	</body>
</html>
