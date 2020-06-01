<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/manuscrito/templates/search.html.twig */
class __TwigTemplate_831f362e9bddd8fed1e94250e72ee2327aee25e09cdfd9b3fa27356da7ba9fe7 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 163, "if" => 171];
        $filters = ["escape" => 164];
        $functions = ["dump" => 204];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape'],
                ['dump']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<main id=\"info-article\">
    <h2>Buscar artículos por:</h2>
    <div class=\"list-type\">
        <div class=\"option\">
            <ul>
                <li class=\"target active\" id=\"name\">
                    <img src=\"/themes/custom/basic/images/article_tipo/articulo.svg\" width=\"100\">
                    <h2>Nombre</h2>
                </li>
                <li class=\"target\" id=\"autor\">
                    <img src=\"/themes/custom/basic/images/article_tipo/autor.svg\" width=\"100\">
                    <h2>Autor</h2>
                </li>
                <li class=\"target\" id=\"tipo\">
                    <img src=\"/themes/custom/basic/images/article_tipo/contenido.svg\" width=\"100\">
                    <h2>Tipo</h2>
                </li>
            </ul>
        </div>

        <div class=\"box-type\">
            <div class=\"article name active\">
                <div class=\"input\">
                    <form action=\"/search/content/by/type\" method=\"get\">
                        <input type=\"search\" name=\"name\" id=\"name-input\" placeholder=\"Nombre del artículo\">
                        <input type=\"submit\" value=\"Buscar\">
                    </form>
                </div>
                <div class=\"search-result\">
                    <div class=\"no-result\">
                        <p>No hay resultados para la búsqueda.</p>
                    </div>
                    <div class=\"result\">
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                        <div class=\"item-news last-article home\">
                            <div class=\"text\">
                                <span class=\"category\"><a href=\"/secciones/32/infografia\" hreflang=\"es\">Infografía </a></span>
                                <div class=\"save no\" data-id=\"71\" data-session=\"authentificate\">
                                <a href=\"#\" class=\"node_saved\">Guardar</a>
                                </div>
                                <h3 class=\"title\"><a href=\"/infografias/cdc-en-chikungunya-71\" hreflang=\"es\">CDC en Chikungunya</a></h3>
                                <p class=\"sumary\">Detalle de Infografía:Sunt irure ullamco irure excepteur minim elit adipisicing laborum occaecat irure ea.</p>
                                <div class=\"info\">
                                    <span class=\"author\"><a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Admin</a> <a href=\"/authenticated/1/admin-panlar\" hreflang=\"es\">Panlar</a></span>
                                    <date>Mayo 2019</date>
                                </div>
                                <div class=\"explorer\"><a href=\"/infografias/cdc-en-chikungunya-71\">Ver más</a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class=\"article autor\">
                <div class=\"input\">
                    <form action=\"/search/content/by/type\" method=\"get\">
                        <select name=\"autor\" id=\"autor-input\">
                            ";
        // line 163
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 164
            echo "                                <option value=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["user"], "uid", [])), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["user"], "name", [])), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 166
        echo "                        </select>
                        <input type=\"submit\" value=\"Buscar\">
                    </form>
                </div>
                <div class=\"search result\">
                    ";
        // line 171
        if ( !(null === ($context["autor"] ?? null))) {
            // line 172
            echo "                        
                    ";
        }
        // line 174
        echo "                </div>
            </div>

            <div class=\"article tipo\">
                <div class=\"input\">
                    <form action=\"/search/content/by/type\" method=\"get\">
                        <select name=\"tipo\" id=\"tipo-input\">
                            <option value=\"article\">Artículo</option>
                            <option value=\"infografias\">Infografías</option>
                            <option value=\"microlearning\">Microlearning</option>
                            <option value=\"podcast\">Podcast</option>
                            <option value=\"videos\">Videos</option>
                            <option value=\"articulo_cientifico\">Articulo cientifico</option>
                            <option value=\"manuscrito_articulo_revision\">Artículo de Revisión</option>
                            <option value=\"manuscrito_articulo_especial\">Artículo especial</option>
                            <option value=\"manuscrito_articulo_original\">Artículo original</option>
                            <option value=\"manuscrito_ciencia_panlar\">Ciencia Panlar</option>
                            <option value=\"manuscrito_columnas\">Columnas</option>
                            <option value=\"manuscrito_comentarios_respues\">Comentarios y Respuestas\t</option>
                            <option value=\"manuscrito_editorial\">Editorial</option>
                            <option value=\"manuscrito_mini_revision\">Mini Revisión</option>
                            <option value=\"manuscrito_multimedia\">Multimedia</option>
                            <option value=\"manuscrito_noticia\">Noticia</option>
                            <option value=\"manuscrito_reportajes_especiales\">Reportajes Especiales\t</option>
                            <option value=\"manuscrito_rondas_clinicas\">Rondas Clínicas</option>
                        </select>
                        <input type=\"submit\" value=\"Buscar\">
                    </form>
                </div>
                <div class=\"search result\">
                ";
        // line 204
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(twig_var_dump($this->env, $context, [0 => $this->sandbox->ensureToStringAllowed(($context["data"] ?? null))]));
        echo "
                    ";
        // line 205
        if ( !(null === ($context["tipo"] ?? null))) {
            // line 206
            echo "                        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(twig_var_dump($this->env, $context, [0 => $this->sandbox->ensureToStringAllowed(($context["tipo"] ?? null))]));
            echo "
                    ";
        }
        // line 208
        echo "                </div>
            </div>
        </div>    
    </div>
</main>";
    }

    public function getTemplateName()
    {
        return "modules/custom/manuscrito/templates/search.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  291 => 208,  285 => 206,  283 => 205,  279 => 204,  247 => 174,  243 => 172,  241 => 171,  234 => 166,  223 => 164,  219 => 163,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/manuscrito/templates/search.html.twig", "/Volumes/HD-Project-Macbook/Web/Desarrollos Web/proyectos/global-rheumatology/modules/custom/manuscrito/templates/search.html.twig");
    }
}
