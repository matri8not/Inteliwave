@extends("layout")

@section("content")
<div class="p-3">
    <div data-role="panel" data-title-caption="About" data-collapsible="true" data-title-icon="<span class='mif-help2'></span>">
		<div class="grid">
	    	<div class="row">
	    		<div class="cell-4 text-center">
                    <img src="/images/deming.png" width=400>
                </div>
	    		<div class="cell">
@if(Auth::User()->language==="fr")
    <h1>À propos de Deming</h1>

    <p><strong>Deming</strong> est un projet open-source conçu pour faciliter la gestion de la sécurité de l'information. Il offre aux organisations les outils nécessaires pour surveiller et mesurer efficacement leurs contrôles de sécurité tout en optimisant la gestion de leur Système de Management de la Sécurité de l'Information (SMSI).</p>

    <h2>Fonctionnalités clés</h2>
    <ul>
        <li>Suivi des performances de la sécurité de l'information.</li>
        <li>Planification et gestion des contrôles de sécurité.</li>
        <li>Génération de rapports détaillés pour une prise de décision éclairée.</li>
    </ul>

    <h2>Open Source</h2>

    <p>Distribué sous licence <a href="https://www.gnu.org/licenses/licenses.html">GPL</a>, Deming s'adapte aux besoins des entreprises en quête d'amélioration continue de leur sécurité de l'information. Pour en savoir plus sur l’utilisation et les fonctionnalités, consultez la <a href="https://dbarzin.github.io/deming/index.fr/">documentation utilisateur</a> et le  <a href="https://github.com/dbarzin">GitHub</a> du projet.</p>
@else
    <h1>About Deming</h1>

    <p><strong>Deming</strong> is an open-source project designed to facilitate the management of information security. It provides organizations with the necessary tools to effectively monitor and measure their security controls while optimizing the management of their Information Security Management System (ISMS).</p>

    <h2>Key Features</h2>
    <ul>
        <li>Monitoring information security performance.</li>
        <li>Planning and managing security measures.</li>
        <li>Generating detailed reports for informed decision-making.</li>
    </ul>

    <h2>Open Source</h2>

    <p>Distributed under the <a href="https://www.gnu.org/licenses/licenses.html">GPL</a> license, Deming adapts to the needs of companies seeking continuous improvement in their information security. For more information on usage and features, refer to the <a href="https://dbarzin.github.io/deming/">user documentation</a> and the project's <a href="https://github.com/dbarzin">GitHub</a>.</p>
@endif
@endsection