<x-layouts.app>
    @php
        $seoTitle = null;
        $seoDescription = 'Somaticx specializes in Website Development & Maintenance and App Development. Transform your digital presence with our expert team.';
    @endphp

    {{-- Hero Section - SRS FR-001 --}}
    <x-hero
        title="We Build <span class='gradient-text'>Digital Excellence</span>"
        subtitle="Somaticx transforms your ideas into powerful web and mobile applications that drive business growth and deliver exceptional user experiences."
        :ctas="[
            ['text' => 'View Our Work', 'url' => route('portfolio.index'), 'primary' => true],
            ['text' => 'Start a Project', 'url' => route('contact.index'), 'primary' => false],
        ]"
    />

    {{-- Tech Marquee - SRS FR-003 --}}
    <section class="relative py-8 overflow-hidden border-y border-white/5 bg-gradient-to-r from-[var(--color-bg-surface)] via-[var(--color-bg-primary)] to-[var(--color-bg-surface)]">
        {{-- Fade edges --}}
        <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-[var(--color-bg-primary)] to-transparent z-10"></div>
        <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-[var(--color-bg-primary)] to-transparent z-10"></div>

        <div class="flex animate-marquee whitespace-nowrap">
            @php
                $technologies = [
                    ['name' => 'Laravel', 'icon' => 'M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z'],
                    ['name' => 'React', 'icon' => 'M14.23 12.004a2.236 2.236 0 0 1-2.235 2.236 2.236 2.236 0 0 1-2.236-2.236 2.236 2.236 0 0 1 2.235-2.236 2.236 2.236 0 0 1 2.236 2.236zm2.648-10.69c-1.346 0-3.107.96-4.888 2.622-1.78-1.653-3.542-2.602-4.887-2.602-.41 0-.783.093-1.106.278-1.375.793-1.683 3.264-.973 6.365C1.98 8.917 0 10.42 0 12.004c0 1.59 1.99 3.097 5.043 4.03-.704 3.113-.39 5.588.988 6.38.32.187.69.275 1.102.275 1.345 0 3.107-.96 4.888-2.624 1.78 1.654 3.542 2.603 4.887 2.603.41 0 .783-.09 1.106-.275 1.374-.792 1.683-3.263.973-6.365C22.02 15.096 24 13.59 24 12.004c0-1.59-1.99-3.097-5.043-4.032.704-3.11.39-5.587-.988-6.38-.318-.184-.688-.277-1.092-.278zm-.005 1.09v.006c.225 0 .406.044.558.127.666.382.955 1.835.73 3.704-.054.46-.142.945-.25 1.44-.96-.236-2.006-.417-3.107-.534-.66-.905-1.345-1.727-2.035-2.447 1.592-1.48 3.087-2.292 4.105-2.295zm-9.77.02c1.012 0 2.514.808 4.11 2.28-.686.72-1.37 1.537-2.02 2.442-1.107.117-2.154.298-3.113.538-.112-.49-.195-.964-.254-1.42-.23-1.868.054-3.32.714-3.707.19-.09.4-.127.563-.132zm4.882 3.05c.455.468.91.992 1.36 1.564-.44-.02-.89-.034-1.345-.034-.46 0-.915.01-1.36.034.44-.572.895-1.096 1.345-1.565zM12 8.1c.74 0 1.477.034 2.202.093.406.582.802 1.203 1.183 1.86.372.64.71 1.29 1.018 1.946-.308.655-.646 1.31-1.013 1.95-.38.66-.773 1.288-1.18 1.87-.728.063-1.466.098-2.21.098-.74 0-1.477-.035-2.202-.093-.406-.582-.802-1.204-1.183-1.86-.372-.64-.71-1.29-1.018-1.946.303-.657.646-1.313 1.013-1.954.38-.66.773-1.286 1.18-1.868.728-.064 1.466-.098 2.21-.098zm-3.635.254c-.24.377-.48.763-.704 1.16-.225.39-.435.782-.635 1.174-.265-.656-.49-1.31-.676-1.947.64-.15 1.315-.283 2.015-.386zm7.26 0c.695.103 1.365.23 2.006.387-.18.632-.405 1.282-.66 1.933-.2-.39-.41-.783-.64-1.174-.225-.392-.465-.774-.705-1.146zm3.063.675c.484.15.944.317 1.375.498 1.732.74 2.852 1.708 2.852 2.476-.005.768-1.125 1.74-2.857 2.475-.42.18-.88.342-1.355.493-.28-.958-.646-1.956-1.1-2.98.45-1.017.81-2.01 1.085-2.964zm-13.395.004c.278.96.645 1.957 1.1 2.98-.45 1.017-.812 2.01-1.086 2.964-.484-.15-.944-.318-1.37-.5-1.732-.737-2.852-1.706-2.852-2.474 0-.768 1.12-1.742 2.852-2.476.42-.18.88-.342 1.356-.494zm11.678 4.28c.265.657.49 1.312.676 1.948-.64.157-1.316.29-2.016.39.24-.375.48-.762.705-1.158.225-.39.435-.788.636-1.18zm-9.945.02c.2.392.41.783.64 1.175.23.39.465.772.705 1.143-.695-.102-1.365-.23-2.006-.386.18-.63.406-1.282.66-1.933zM17.92 16.32c.112.493.2.968.254 1.423.23 1.868-.054 3.32-.714 3.708-.147.09-.338.128-.563.128-1.012 0-2.514-.807-4.11-2.28.686-.72 1.37-1.536 2.02-2.44 1.107-.118 2.154-.3 3.113-.54zm-11.83.01c.96.234 2.006.415 3.107.532.66.905 1.345 1.727 2.035 2.446-1.595 1.483-3.092 2.295-4.11 2.295-.22-.005-.406-.05-.553-.132-.666-.38-.955-1.834-.73-3.703.054-.46.142-.944.25-1.438zm4.56.64c.44.02.89.034 1.345.034.46 0 .915-.01 1.36-.034-.44.572-.895 1.095-1.345 1.565-.455-.47-.91-.993-1.36-1.565z'],
                    ['name' => 'Vue.js', 'icon' => 'M24 1.61h-9.94L12 5.16 9.94 1.61H0l12 20.78L24 1.61zM12 14.08L5.16 2.23h4.43L12 6.41l2.41-4.18h4.43L12 14.08z'],
                    ['name' => 'Node.js', 'icon' => 'M11.998 24c-.321 0-.641-.084-.922-.247l-2.936-1.737c-.438-.245-.224-.332-.08-.383.585-.203.703-.25 1.328-.604.065-.037.151-.023.218.017l2.256 1.339c.082.045.198.045.275 0l8.795-5.076c.082-.047.134-.141.134-.238V6.921c0-.099-.053-.193-.137-.242l-8.791-5.072c-.081-.047-.189-.047-.271 0L3.075 6.68c-.086.049-.139.146-.139.243v10.15c0 .097.054.189.139.235l2.409 1.392c1.307.654 2.108-.116 2.108-.89V7.787c0-.142.114-.253.256-.253h1.115c.139 0 .255.112.255.253v10.021c0 1.745-.95 2.745-2.604 2.745-.508 0-.909 0-2.026-.551L2.28 18.675c-.57-.329-.922-.943-.922-1.604V6.921c0-.659.353-1.275.922-1.603L11.075.24c.558-.318 1.303-.318 1.857 0l8.794 5.078c.57.329.924.944.924 1.603v10.15c0 .659-.354 1.273-.924 1.604l-8.794 5.078c-.28.163-.6.247-.934.247zm2.725-6.984c-3.868 0-4.678-1.776-4.678-3.265 0-.141.113-.253.255-.253h1.14c.127 0 .234.092.251.216.171 1.155.68 1.738 3.001 1.738 1.848 0 2.636-.418 2.636-1.399 0-.566-.223-.985-3.095-1.268-2.4-.236-3.885-.767-3.885-2.688 0-1.771 1.493-2.827 3.998-2.827 2.812 0 4.205.976 4.383 3.073.007.076-.021.149-.073.205-.052.054-.123.086-.199.086h-1.144c-.12 0-.227-.085-.249-.202-.277-1.231-.949-1.623-2.718-1.623-2.002 0-2.236.698-2.236 1.22 0 .634.275.819 3.001 1.177 2.7.355 3.978.858 3.978 2.767 0 1.912-1.594 3.013-4.366 3.013z'],
                    ['name' => 'PHP', 'icon' => 'M7.01 10.207h-.944l-.515 2.648h.838c.556 0 .97-.105 1.242-.314.272-.21.455-.559.55-1.049.092-.47.05-.802-.124-.995-.175-.193-.523-.29-1.047-.29zM12 5.688C5.373 5.688 0 8.514 0 12s5.373 6.313 12 6.313S24 15.486 24 12c0-3.486-5.373-6.312-12-6.312zm-3.26 7.451c-.261.25-.575.438-.917.551-.336.108-.765.164-1.285.164H5.357l-.327 1.681H3.652l1.23-6.326h2.65c.797 0 1.378.209 1.744.628.366.418.476 1.002.33 1.752-.051.267-.142.52-.272.758-.13.236-.296.449-.493.633zm4.946.508c-.26.246-.574.433-.916.545-.336.108-.765.164-1.285.164h-1.18l-.328 1.681h-1.378l1.23-6.326h2.649c.797 0 1.378.209 1.744.628.366.418.477 1.003.33 1.752-.05.268-.141.52-.271.758-.13.236-.295.45-.492.633zm5.905-2.445h-1.394l-.235 1.213h1.21c.38 0 .664-.072.85-.217.188-.144.314-.385.378-.725.063-.328.01-.557-.16-.686-.169-.13-.464-.194-.886-.194zm5.905 2.445c-.26.246-.574.433-.916.545-.336.108-.765.164-1.285.164h-1.18l-.328 1.681h-1.378l1.23-6.326h2.649c.797 0 1.378.209 1.744.628.366.418.477 1.003.33 1.752-.05.268-.141.52-.271.758-.13.236-.295.45-.492.633zm-2.905-2.445h.944l-.515 2.648h.838c.556 0 .97-.105 1.242-.314.272-.21.455-.559.55-1.049.092-.47.05-.802-.124-.995-.175-.193-.523-.29-1.047-.29zm-9.946.508c-.261.25-.575.438-.917.551-.336.108-.765.164-1.285.164H5.357l-.327 1.681H3.652l1.23-6.326h2.65c.797 0 1.378.209 1.744.628.366.418.476 1.002.33 1.752-.051.267-.142.52-.272.758-.13.236-.296.449-.493.633z'],
                    ['name' => 'MySQL', 'icon' => 'M16.405 5.501c-.115 0-.193.014-.274.033v.013h.014c.054.104.146.18.214.273.054.107.1.214.154.32l.014-.015c.094-.066.14-.172.14-.333-.04-.047-.046-.094-.08-.14-.04-.067-.126-.1-.18-.153zM5.77 18.695h-.927a50.854 50.854 0 0 0-.27-4.41h-.008l-1.41 4.41H2.45l-1.4-4.41h-.01a72.892 72.892 0 0 0-.195 4.41H0c.055-1.966.192-3.81.41-5.53h1.15l1.335 4.064h.008l1.347-4.063h1.095c.242 2.015.384 3.86.428 5.53zm4.017-4.08c-.378 2.045-.876 3.533-1.492 4.46-.482.73-1.01 1.095-1.583 1.095-.153 0-.34-.046-.566-.138v-.494c.11.017.24.026.386.026.268 0 .483-.075.647-.222.197-.18.295-.382.295-.605 0-.155-.077-.47-.23-.944L6.23 14.615h.91l.727 2.36c.164.536.233.91.205 1.123.4-1.064.678-2.227.835-3.483zm12.325 4.08h-2.63v-5.53h.885v4.85h1.745zm-3.32.135l-1.016-.5c.09-.076.177-.158.255-.25.433-.506.648-1.258.648-2.253 0-1.83-.718-2.746-2.155-2.746-.704 0-1.254.232-1.65.697-.43.508-.646 1.256-.646 2.245 0 .972.19 1.686.574 2.14.35.41.822.613 1.416.613.325 0 .628-.06.91-.18l1.313.772.352-.538zm-1.535-3.14c0 .64-.088 1.135-.264 1.485-.158.315-.452.472-.882.472-.362 0-.634-.144-.817-.43-.22-.345-.33-.89-.33-1.636 0-1.31.405-1.963 1.216-1.963.376 0 .65.153.822.46.193.34.255.872.255 1.612z'],
                    ['name' => 'Tailwind CSS', 'icon' => 'M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z'],
                    ['name' => 'Alpine.js', 'icon' => 'M0 12l9.6-8L12 6.4 4.8 12l7.2 5.6-2.4 2.4zm14.4 0l-7.2 5.6 2.4 2.4L24 12l-9.6-8L12 6.4z'],
                    ['name' => 'Swift', 'icon' => 'M23.933 7.63a9.06 9.06 0 0 0-.218-.994 5.617 5.617 0 0 0-1.033-1.89 5.637 5.637 0 0 0-1.691-1.378 5.624 5.624 0 0 0-1.98-.678c-.353-.07-.71-.108-1.07-.114a29.767 29.767 0 0 0-.94-.009H7.001c-.32 0-.64.003-.958.01a5.6 5.6 0 0 0-1.069.114 5.633 5.633 0 0 0-3.67 2.056A5.62 5.62 0 0 0 .272 6.635a9.14 9.14 0 0 0-.218.994 26.7 26.7 0 0 0-.05 1.203v6.336c0 .404.013.805.05 1.203.029.34.092.679.218.994a5.618 5.618 0 0 0 2.725 2.926 5.63 5.63 0 0 0 1.98.678c.353.07.71.108 1.07.114.318.007.636.01.958.01h9.999c.32 0 .64-.003.958-.01a5.6 5.6 0 0 0 1.07-.114 5.633 5.633 0 0 0 3.67-2.056 5.62 5.62 0 0 0 1.032-1.89c.126-.315.189-.654.218-.994.037-.398.05-.8.05-1.203V8.832c0-.404-.013-.805-.05-1.203zM12 17.968c-.428 0-.853-.027-1.274-.083a8.482 8.482 0 0 1-3.71-1.292c-.193-.12-.38-.253-.556-.395l5.867-2.812c.083-.04.214-.04.297 0l3.6 1.725c.214.103.297.36.186.565a.44.44 0 0 1-.186.186l-4.224 2.022v.084z'],
                    ['name' => 'Kotlin', 'icon' => 'M0 0h24v24H0V0zm0 0L12 12 0 24V0zm12 12L24 0v24L12 12z'],
                    ['name' => 'Flutter', 'icon' => 'M14.314 0L2.3 12 6 15.7 21.971 0h-7.657zm.014 11.072L7.857 17.53l6.47 6.47H22L15.528 17.53 22 11.072h-7.672z'],
                    ['name' => 'AWS', 'icon' => 'M6.763 10.036c0 .296.032.535.088.71.064.176.144.368.256.576.04.063.056.127.056.183 0 .08-.048.16-.152.24l-.503.335a.383.383 0 0 1-.208.072c-.08 0-.16-.04-.239-.112a2.47 2.47 0 0 1-.287-.375 6.18 6.18 0 0 1-.248-.471c-.622.734-1.405 1.101-2.347 1.101-.67 0-1.205-.191-1.596-.574-.391-.384-.59-.894-.59-1.533 0-.678.239-1.23.726-1.644.487-.415 1.133-.623 1.955-.623.272 0 .551.024.846.064.296.04.6.104.918.176v-.583c0-.607-.127-1.03-.375-1.277-.255-.248-.686-.367-1.3-.367-.28 0-.568.031-.863.103-.295.072-.583.16-.862.272a2.287 2.287 0 0 1-.28.104.488.488 0 0 1-.127.023c-.112 0-.168-.08-.168-.247v-.391c0-.128.016-.224.056-.28a.597.597 0 0 1 .224-.167c.279-.144.614-.264 1.005-.36a4.84 4.84 0 0 1 1.246-.151c.95 0 1.644.216 2.091.647.439.43.662 1.085.662 1.963v2.586zm-3.24 1.214c.263 0 .534-.048.822-.144.287-.096.543-.271.758-.51.128-.152.224-.32.272-.512.047-.191.08-.423.08-.694v-.335a6.66 6.66 0 0 0-.735-.136 6.02 6.02 0 0 0-.75-.048c-.535 0-.926.104-1.19.32-.263.215-.39.518-.39.917 0 .375.095.655.295.846.191.2.47.296.838.296zm6.41.862c-.144 0-.24-.024-.304-.08-.064-.048-.12-.16-.168-.311L7.586 5.55a1.398 1.398 0 0 1-.072-.32c0-.128.064-.2.191-.2h.783c.151 0 .255.025.31.08.065.048.113.16.16.312l1.342 5.284 1.245-5.284c.04-.16.088-.264.151-.312a.549.549 0 0 1 .32-.08h.638c.152 0 .256.025.32.08.063.048.12.16.151.312l1.261 5.348 1.381-5.348c.048-.16.104-.264.16-.312a.52.52 0 0 1 .311-.08h.743c.127 0 .2.065.2.2 0 .04-.009.08-.017.128a1.137 1.137 0 0 1-.056.2l-1.923 6.17c-.048.16-.104.263-.168.311a.51.51 0 0 1-.303.08h-.687c-.151 0-.255-.024-.32-.08-.063-.056-.119-.16-.15-.32l-1.238-5.148-1.23 5.14c-.04.16-.087.264-.15.32-.065.056-.177.08-.32.08zm10.256.215c-.415 0-.83-.048-1.229-.143-.399-.096-.71-.2-.918-.32-.128-.071-.215-.151-.247-.223a.563.563 0 0 1-.048-.224v-.407c0-.167.064-.247.183-.247.048 0 .096.008.144.024.048.016.12.048.2.08.271.12.566.215.878.279.319.064.63.096.95.096.502 0 .894-.088 1.165-.264a.86.86 0 0 0 .415-.758.777.777 0 0 0-.215-.559c-.144-.151-.416-.287-.807-.415l-1.157-.36c-.583-.183-1.014-.454-1.277-.813a1.902 1.902 0 0 1-.4-1.158c0-.335.073-.63.216-.886.144-.255.335-.479.575-.654.24-.184.51-.32.83-.415a3.69 3.69 0 0 1 1.022-.136c.18 0 .366.008.558.024.191.016.375.04.551.071.168.032.327.072.479.12.152.048.272.096.359.144.128.072.224.152.28.24.056.08.088.192.088.336v.376c0 .168-.064.256-.183.256a.876.876 0 0 1-.319-.112 3.7 3.7 0 0 0-1.541-.311c-.455 0-.815.072-1.062.216-.248.144-.375.359-.375.654 0 .208.08.39.24.543.16.152.455.303.886.439l1.11.352c.574.184.99.44 1.237.767.247.327.367.702.367 1.117 0 .343-.071.659-.207.95a2.138 2.138 0 0 1-.59.734 2.726 2.726 0 0 1-.926.479 4.116 4.116 0 0 1-1.197.168z'],
                ];
            @endphp
            @foreach($technologies as $tech)
                <span class="group inline-flex items-center mx-6 text-xl font-semibold text-text-muted hover:text-accent transition-all duration-300">
                    <span class="mr-3 text-accent/30 group-hover:text-accent transition-colors">⬢</span>
                    {{ $tech['name'] }}
                </span>
            @endforeach
            @foreach($technologies as $tech)
                <span class="group inline-flex items-center mx-6 text-xl font-semibold text-text-muted hover:text-accent transition-all duration-300">
                    <span class="mr-3 text-accent/30 group-hover:text-accent transition-colors">⬢</span>
                    {{ $tech['name'] }}
                </span>
            @endforeach
        </div>
    </section>

    {{-- Services Section - SRS FR-004 --}}
    <section class="relative py-32 overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container relative">
            <x-section-heading
                badge="What We Do"
                title="Our <span class='gradient-text'>Services</span>"
                subtitle="We specialize in creating digital solutions that help businesses thrive in the modern world."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services ?? [] as $service)
                    <x-service-card :service="$service" />
                @empty
                    @foreach([
                        ['title' => 'Website Development', 'tagline' => 'Custom web solutions', 'description' => 'From simple landing pages to complex web applications, we build websites that perform.', 'icon' => 'code'],
                        ['title' => 'App Development', 'tagline' => 'Mobile-first approach', 'description' => 'Native and cross-platform mobile apps that deliver exceptional user experiences.', 'icon' => 'mobile'],
                        ['title' => 'Website Maintenance', 'tagline' => 'Keep it running smoothly', 'description' => 'Ongoing support, updates, and optimization to keep your digital presence at its best.', 'icon' => 'settings'],
                    ] as $index => $placeholder)
                        <div
                            class="service-card group relative p-8 rounded-3xl bg-gradient-to-b from-white/5 to-transparent border border-white/5 hover:border-accent/30 transition-all duration-500"
                            x-data="{ visible: false }"
                            x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            {{-- Glow effect on hover --}}
                            <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-accent/10 to-accent-2/10 opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500 -z-10"></div>

                            {{-- Icon --}}
                            <div class="relative w-16 h-16 mb-8">
                                <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                                <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center">
                                    @if($placeholder['icon'] === 'code')
                                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    @elseif($placeholder['icon'] === 'mobile')
                                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            {{-- Content --}}
                            <h3 class="text-2xl font-bold font-display mb-2 group-hover:text-accent transition-colors">{{ $placeholder['title'] }}</h3>
                            <p class="text-accent/70 text-sm font-medium mb-4">{{ $placeholder['tagline'] }}</p>
                            <p class="text-text-muted mb-8 leading-relaxed">{{ $placeholder['description'] }}</p>

                            {{-- Link --}}
                            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-white font-medium group/link">
                                <span class="relative">
                                    Learn More
                                    <span class="absolute bottom-0 left-0 w-0 h-px bg-accent group-hover/link:w-full transition-all duration-300"></span>
                                </span>
                                <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                @endforelse
            </div>

            {{-- View all services link --}}
            <div class="text-center mt-16">
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-text-muted hover:text-white transition-colors group">
                    <span>View all services</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Projects Section - SRS FR-005 --}}
    <section class="relative py-32 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <x-section-heading
                badge="Our Work"
                title="Featured <span class='gradient-text'>Projects</span>"
                subtitle="Explore our latest work and see how we've helped businesses achieve their digital goals."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects ?? [] as $project)
                    <x-project-card :project="$project" />
                @empty
                    @for($i = 0; $i < 6; $i++)
                        <div
                            class="project-card group relative rounded-2xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5"
                            x-data="{ visible: false }"
                            x-intersect.once="setTimeout(() => visible = true, {{ $i * 100 }})"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            <div class="aspect-video bg-gradient-to-br from-accent/20 to-accent-2/20 relative overflow-hidden">
                                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-4xl font-bold text-white/10">{{ $i + 1 }}</span>
                                </div>
                                {{-- Hover overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-3 py-1 text-xs font-medium bg-accent/10 text-accent rounded-full">Web App</span>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 group-hover:text-accent transition-colors">Project Title {{ $i + 1 }}</h3>
                                <p class="text-text-muted text-sm line-clamp-2">A brief description of this amazing project and what we achieved.</p>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            <div class="text-center mt-16">
                <a href="{{ route('portfolio.index') }}" class="group relative inline-flex items-center gap-3 px-8 py-4 overflow-hidden rounded-full font-semibold transition-all duration-300">
                    <span class="absolute inset-0 border-2 border-accent rounded-full group-hover:border-accent-2 transition-colors"></span>
                    <span class="absolute inset-0 bg-accent/0 group-hover:bg-accent/10 rounded-full transition-colors"></span>
                    <span class="relative text-white">View All Projects</span>
                    <svg class="relative w-5 h-5 text-accent transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Stats Section - SRS FR-006 --}}
    <section class="py-32 relative overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-accent/5 to-accent-2/5 rounded-full blur-3xl"></div>
        </div>

        <div class="container relative">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                @forelse($stats ?? [] as $stat)
                    <x-stat-counter :stat="$stat" />
                @empty
                    @foreach([
                        ['value' => 120, 'label' => 'Projects Delivered', 'suffix' => '+', 'icon' => 'folder'],
                        ['value' => 85, 'label' => 'Happy Clients', 'suffix' => '+', 'icon' => 'users'],
                        ['value' => 5, 'label' => 'Years Experience', 'suffix' => '+', 'icon' => 'calendar'],
                        ['value' => 99, 'label' => 'Uptime Guarantee', 'suffix' => '%', 'icon' => 'chart'],
                    ] as $index => $placeholder)
                        <div
                            class="relative text-center p-8 rounded-3xl bg-gradient-to-b from-white/5 to-transparent border border-white/5"
                            x-data="{ count: 0, visible: false }"
                            x-intersect.once="
                                visible = true;
                                setTimeout(() => {
                                    const target = {{ $placeholder['value'] }};
                                    const duration = 2000;
                                    const start = performance.now();
                                    const update = (time) => {
                                        const progress = Math.min((time - start) / duration, 1);
                                        count = Math.floor(progress * target);
                                        if (progress < 1) requestAnimationFrame(update);
                                    };
                                    requestAnimationFrame(update);
                                }, {{ $index * 150 }});
                            "
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            <div class="w-14 h-14 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                @if($placeholder['icon'] === 'folder')
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                @elseif($placeholder['icon'] === 'users')
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                @elseif($placeholder['icon'] === 'calendar')
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-3">
                                <span class="gradient-text" x-text="count">0</span><span class="gradient-text">{{ $placeholder['suffix'] }}</span>
                            </div>
                            <p class="text-text-muted font-medium">{{ $placeholder['label'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Testimonials Section - SRS FR-007 --}}
    <section class="py-32 bg-[var(--color-bg-surface)] relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        <div class="container">
            <x-section-heading
                badge="Testimonials"
                title="What Our <span class='gradient-text'>Clients Say</span>"
                subtitle="Don't just take our word for it. Here's what our clients have to say about working with us."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonials ?? [] as $testimonial)
                    <x-testimonial-card :testimonial="$testimonial" />
                @empty
                    @foreach([
                        ['name' => 'John Smith', 'company' => 'TechCorp', 'role' => 'CEO', 'content' => 'Somaticx delivered an exceptional website that exceeded our expectations. Their attention to detail and technical expertise is unmatched.', 'rating' => 5],
                        ['name' => 'Sarah Johnson', 'company' => 'StartupXYZ', 'role' => 'Founder', 'content' => 'Working with Somaticx was a pleasure from start to finish. They understood our vision and brought it to life perfectly.', 'rating' => 5],
                        ['name' => 'Michael Chen', 'company' => 'InnovateCo', 'role' => 'CTO', 'content' => 'The mobile app Somaticx built for us has been a game-changer. Professional team, excellent communication, and outstanding results.', 'rating' => 5],
                    ] as $index => $placeholder)
                        <div
                            class="testimonial-card relative p-8 rounded-3xl bg-[var(--color-bg-primary)] border border-white/5 hover:border-accent/20 transition-all duration-500"
                            x-data="{ visible: false }"
                            x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                            style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                        >
                            {{-- Quote icon --}}
                            <div class="absolute top-6 right-6 text-accent/20">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                            </div>

                            {{-- Stars --}}
                            <div class="flex gap-1 mb-6">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400 fill-yellow-400" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>

                            {{-- Content --}}
                            <p class="text-text-muted mb-8 leading-relaxed text-lg">"{{ $placeholder['content'] }}"</p>

                            {{-- Author --}}
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-full blur-sm"></div>
                                    <div class="relative w-14 h-14 rounded-full bg-gradient-to-br from-accent to-accent-2 flex items-center justify-center font-bold text-white text-lg">
                                        {{ strtoupper(substr($placeholder['name'], 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">{{ $placeholder['name'] }}</p>
                                    <p class="text-sm text-text-muted">{{ $placeholder['role'] }} at {{ $placeholder['company'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-32">
        <div class="container">
            <div
                class="relative rounded-[2.5rem] overflow-hidden"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                {{-- Background layers --}}
                <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-accent-2/20"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>

                {{-- Animated gradient orbs --}}
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-accent/30 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-accent-2/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

                {{-- Content --}}
                <div class="relative z-10 p-12 md:p-20 text-center">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6">
                        Ready to Start Your <span class="gradient-text">Project</span>?
                    </h2>
                    <p class="text-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                        Let's discuss how we can help bring your vision to life. Get in touch today for a free consultation.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Get in Touch</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            View Our Work
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
