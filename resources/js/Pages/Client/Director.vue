<template>
	<app-layout :orchestra="orchestra" class="profile-page">
		<div class="profile-page">
			<div class="wrapper">
				<div class="page-header clear-filter page-header-small" filter-color="black">
					<div class="page-header-image" data-parallax="true" style="background-image: url(/img/teatro.jpg); transform: translate3d(0px, 0px, 0px); background-position: top;">
					</div>
					<div class="container">
						<div class="photo-container">
							<img src="/img/director.png" alt="">
						</div>
						<h3 class="title">Franz Javier Condori Leaño</h3>
						<p class="category">Director</p>
					</div>
				</div>
				<div class="section">
					<div class="container">
						<div class="button-container">
							<a href="https://www.facebook.com/orquestavivalditarija" class="btn btn-lg btn-cafe btn-icon btn-round">
								<i class="fab fa-facebook-square" target="_blank"></i>
							</a>
							<a href="https://api.whatsapp.com/send?phone=59172962410&text=Hola...%20%F0%9F%98%8A" class="btn btn-lg btn-cafe btn-icon btn-round" target="_blank">
								<i class="fab fa-whatsapp"></i>
							</a>
							<a href="https://www.youtube.com/channel/UCZ3DlFv2oShyuD5WKrtrCaw" class="btn btn-lg btn-cafe btn-icon btn-round">
								<i class="fab fa-youtube" target="_blank"></i>
							</a>
						</div>
						<h3 class="title">Franz Condori y el nacimiento de la Orquesta Sinfónica de Tarija</h3>
						<h5 class="description text-center">"Escuchaba sus temas todos los días, el sueño era tocar como Alfredo Domínguez, y siguió ese camino, Franz Condori es un potosino que encontró en Tarija su vocación por la música y gracias su iniciativa y la de otros cultores de este arte, después de muchas vicisitudes, logró crear la Orquesta Sinfónica de Tarija."</h5>
						<h5 class="title">Relocalización</h5>
						<p>
							A causa de un decreto emitido el 25 de agosto de 1986, muchas familias fueron “relocalizadas”, un eufemismo para cubrir el despido de miles de trabajadores que vivían en los campamentos mineros de varios lugares en Potosí. Los Condori no fueron ajenos a este hecho, abandonaron el poblado natal de Franz, Tatasi – Sub Chichas, para establecerse en Tarija, él tenía cuatro años.
						</p>
						<p>
							Octavo hijo de una familia de 10 hermanos, ingresó a la escuela José Manuel Ávila, luego pasó a secundaria al Belgrano y ya tenía inclinaciones artísticas porque en este periodo ganó un concurso de pintura. Sin embargo, la presencia de una guitarra en casa -propiedad de su hermano mayor- decidió sus inclinaciones lúdicas.
						</p>
						<p>
							A la edad de 10 años aprendió a tocar la guitarra de manera autodidacta de la mano de su hermano mayor y a los 14 ingresó al Instituto de Música “Mario Estenssoro”, allí tuvo contacto con profesores como Carmen Verdún y Francisco Yucra y su pasión por este instrumento aumentaba a tal punto que anhelaba tocar como Alfredo Domínguez, su ídolo de adolescencia.
						</p>
						<p>
							Terminado el colegio, con 17 años encima, se fue a buscar sus sueños a Cochabamba, quiso ingresar a la academia Man Césped, pero vio que en Potosí las cosas serían mejores porque allí existía la carrera de música en la Facultad de Artes a nivel de licenciatura.
						</p>
						<p>
							Culminados sus estudios, cinco años después, por el año 2004, retornó a Tarija con el compromiso de trabajar porque había que colaborar económicamente con la familia, empezó a dictar clases de música en la Unidad Educativa Bautista Evangélica (UBET) Tarija, aquí creó una pequeña orquesta de flautas, además de un coro, pero  vio que ser profesor de aula no era lo suyo.
						</p>
						<p>
							Empezó a perfeccionarse en la ejecución del violín con la profesora japonesa Kana Kuano y, un día, el director del Instituto Mario Estenssoro le propuso dar clases en esta institución, no lo pensó dos veces y empezó a enseñar los misterios del violín y los instrumentos de cuerdas a 14 muchachos que en el futuro serían los que formarían la Orquesta Vivaldi y la base de la Sinfónica de Tarija.
						</p>
						<p>
							“Ese año no me pagaron nada porque no salió el ítem, había contratiempos, era joven, no todos apostaban a que dicte clases, además pasaba en lo que era un baño en construcción, pero con todo eso los chicos salieron adelante. Ahora forman parte incluso de la filarmónica de Bolivia, son como mis hijos”.
						</p>
						<p>
							En el segundo año de dictar clases ya contaba con 40 estudiantes. Frecuentaba la ciudad de Santa Cruz para aprender del profesor Rubén Darío las pautas para formar una orquesta por secciones. En esta época también formaba parte de la Orquesta de Cámara de Tarija.
						</p>
						<p>
							Hubo un momento que se enteró que existían unos 200 instrumentos musicales nuevos que dormían el sueño de los justos en un depósito de la Gobernación, provenían de la gestión de Mario Cossío y de un proyecto que quedó estancado. En esa oportunidad fue invitado a trabajar en la entidad gubernativa y vio que era su oportunidad. Dejó el Instituto y Orquesta para dedicarse a la creación de una sinfónica.
						</p>
						<div class="section-story-overview">
							<div class="row">
								<div class="col-md-4">
									<img class="rounded img-raised" alt="Orquesta Vivaldi Tarija" src="/img/director-h1.jpg">
								</div>
								<div class="col-md-4">
									<img class="rounded img-raised" alt="Orquesta Vivaldi Tarija" src="/img/integrantes-h15.jpg">
								</div>
								<div class="col-md-4">
									<img class="rounded img-raised" alt="Orquesta Vivaldi Tarija" src="/img/director-h2.jpg">
								</div>
								<div class="col-md-6">
									<img class="rounded img-raised" alt="Orquesta Vivaldi Tarija" src="/img/director-h3.jpg">
								</div>
								<div class="col-md-6">
									<img class="rounded img-raised" alt="Orquesta Vivaldi Tarija" src="/img/director-h4.jpg">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</app-layout>
</template>
<script>
import AppLayout from '@/Pages/Client/Layouts/AppLayout'
export default {
	props: [
	'canLogin',
	'canRegister',
	'laravelVersion',
	'phpVersion',
	'orchestra',
	],

	components: {
		AppLayout,
	},

	data() {
		return {

		}
	},

	mounted() {
	},

	methods: {

	}
};
</script>
