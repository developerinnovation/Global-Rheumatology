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

/* themes/custom/basic/templates/html.html.twig */
class __TwigTemplate_c822d9da4990ac5e2f8448363df5ff838e62a4f6b584f9ccfdfdafecab5e75e3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 6, "set" => 32, "for" => 32, "include" => 45];
        $filters = ["escape" => 6, "safe_join" => 19, "date" => 25, "merge" => 32, "clean_class" => 32, "render" => 32, "t" => 39];
        $functions = ["attach_library" => 6];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for', 'include'],
                ['escape', 'safe_join', 'date', 'merge', 'clean_class', 'render', 't'],
                ['attach_library']
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
        // line 6
        echo "<!DOCTYPE html> ";
        if ($this->getAttribute(($context["ie_enabled_versions"] ?? null), "ie8", [])) {
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("basic/ie8"), "html", null, true);
            echo " ";
        }
        echo " ";
        if (($this->getAttribute(($context["ie_enabled_versions"] ?? null), "ie9", []) || $this->getAttribute(($context["ie_enabled_versions"] ?? null), "ie8", []))) {
            // line 7
            echo "<!--[if lt IE 7]>     <html";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["html_attributes"] ?? null), "addClass", [0 => "no-js", 1 => "lt-ie9", 2 => "lt-ie8", 3 => "lt-ie7"], "method")), "html", null, true);
            echo "><![endif]-->
<!--[if IE 7]>        <html";
            // line 8
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["html_attributes"] ?? null), "removeClass", [0 => "lt-ie7"], "method")), "html", null, true);
            echo "><![endif]-->
<!--[if IE 8]>        <html";
            // line 9
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["html_attributes"] ?? null), "removeClass", [0 => "lt-ie8"], "method")), "html", null, true);
            echo "><![endif]-->
<!--[if gt IE 8]><!-->
<html";
            // line 11
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["html_attributes"] ?? null), "removeClass", [0 => "lt-ie9"], "method")), "html", null, true);
            echo ">
    <!--<![endif]-->
    ";
        } else {
            // line 14
            echo "<html";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["html_attributes"] ?? null)), "html", null, true);
            echo ">
        ";
        }
        // line 16
        echo "
        <head>
            <head-placeholder token=\"";
        // line 18
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
                <title>";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["head_title"] ?? null)), " | "));
        echo "</title>
                <css-placeholder token=\"";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
                    <js-placeholder token=\"";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
                        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js\"></script>
                        <script type=\"text/javascript\" src=\"/themes/custom/basic/js/jquery.mousewheel-3.0.4.pack.js\"></script>
                        <script type=\"text/javascript\" src=\"/themes/custom/basic/js/owlcarrousel/owl-carousel/owl.carousel.js\"></script>
                        <script type=\"text/javascript\" src=\"/themes/custom/basic/js/general.js?temp=";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, " now ", "m/d/Y/H/i/s "), "html", null, true);
        echo "\"></script>
                        <link rel=\"stylesheet\" href=\"/themes/custom/basic/js/owlcarrousel/owl-carousel/owl.carousel.css\">
                        <link rel=\"stylesheet\" href=\"/themes/custom/basic/js/mediaelement-and-player.min.js\">
                        </script>
                        <link rel=\"stylesheet\" href=\"/themes/custom/basic/css/base/base.css?temp=";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, " now ", "m/d/Y/H/i/s "), "html", null, true);
        echo "\" />
                        <link rel=\"stylesheet\" href=\"/themes/custom/basic/css/puntual.css?temp=";
        // line 30
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, " now ", "m/d/Y/H/i/s "), "html", null, true);
        echo "\" />
                        <link rel=\"stylesheet\" href=\"/themes/custom/basic/css/components/components.css?temp=";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, " now ", "m/d/Y/H/i/s "), "html", null, true);
        echo "\" />
                        <link href=\"https://fonts.googleapis.com/css?family=Lato:400,700,900&amp;subset=latin-ext\" rel=\"stylesheet\"> ";
        // line 32
        $context["classes"] = [];
        echo " ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["user"] ?? null), "roles", []));
        foreach ($context['_seq'] as $context["_key"] => $context["role"]) {
            echo " ";
            $context["classes"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["classes"] ?? null)), [0 => ("role--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($context["role"])))]);
            echo " ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['role'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " ";
        $context["sidebar_first"] = $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])));
        echo " ";
        $context["sidebar_second"] = $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])));
        // line 34
        echo "                        <body";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null), 1 => (( !($context["is_front"] ?? null)) ? ("with-subnav") : ("")), 2 => ((($context["sidebar_first"] ?? null)) ? ("sidebar-first") : ("")), 3 => ((($context["sidebar_second"] ?? null)) ? ("sidebar-second") : ("")), 4 => ((((($context["sidebar_first"] ?? null) &&  !($context["sidebar_second"] ?? null)) || (($context["sidebar_second"] ?? null) &&  !($context["sidebar_first"] ?? null)))) ? ("one-sidebar") : ("")), 5 => (((($context["sidebar_first"] ?? null) &&         // line 35
($context["sidebar_second"] ?? null))) ? ("two-sidebars") : ("")), 6 => ((( !($context["sidebar_first"] ?? null) &&  !($context["sidebar_second"] ?? null))) ? ("no-sidebar") : (""))], "method")), "html", null, true);
        echo ">

                            <div id=\"skip\">
                                <a href=\"#main-menu\" class=\"visually-hidden focusable skip-link\">
        ";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Skip to main navigation"));
        echo "
      </a>
                            </div>


                            <!-- ______________________ HEADER _______________________ -->
                            ";
        // line 45
        $this->loadTemplate("@basic/header.html.twig", "themes/custom/basic/templates/html.html.twig", 45)->display($context);
        // line 46
        echo "                            <!-- ____________________ END HEADER ____________________ -->



                            <!-- ______________________ MAIN _______________________ -->
                            ";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_top"] ?? null)), "html", null, true);
        echo " ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page"] ?? null)), "html", null, true);
        echo " ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_bottom"] ?? null)), "html", null, true);
        echo "

                            <div class=\"launcher-box-message\">
                                <div id=\"launcher-button\" class=\"send-article new-article ";
        // line 54
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo "authentificate";
        } else {
            echo "anonime";
        }
        echo "\" data-heref=\"";
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo " /new/send/manuscrito ";
        } else {
            echo "  ";
        }
        echo "\">
                                    <img src=\"\\themes\\custom\\basic\\images\\icon-articulo.svg\" border=\"0\" alt=\"Twitter\" width=\"48\" height=\"48\">
                                    <span class=\"launcher-message\">Envía un artículo</span>
                                </div>
                            </div>

                            <!-- ___________________ END MAIN _______________________ -->


                            <!-- ______________________ FOOTER _______________________ -->
                            ";
        // line 64
        $this->loadTemplate("@basic/footer.html.twig", "themes/custom/basic/templates/html.html.twig", 64)->display($context);
        // line 65
        echo "                            <!-- __________________ END FOOTER _______________________ -->
                            <js-bottom-placeholder token=\"";
        // line 66
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
                                ";
        // line 67
        if ($this->getAttribute(($context["browser_sync"] ?? null), "enabled", [])) {
            // line 68
            echo "                                <script id=\"__bs_script__\">
                                    document.write(\"<script async src='http://";
            // line 69
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["browser_sync"] ?? null), "host", [])), "html", null, true);
            echo ":";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["browser_sync"] ?? null), "port", [])), "html", null, true);
            echo "/browser-sync/browser-sync-client.js'><\\/script>\".replace(\"HOST\", location.hostname));
                                </script>
                                ";
        }
        // line 72
        echo "                                </body>
                                <style>
                                    select#edit-field-areas-interes-academico--2 {
                                        height: 130px;
                                    }
    select#edit-view-mode {
        display: none;
    }
    form#node-preview-form-select {
        color: #fff;
    }
    form#node-preview-form-select a#edit-backlink {
        text-decoration: underline blink;
        color: #ffffff;
        border-radius: 6px;
        background: #486d95;
        width: calc(55% - 6px);
        padding: 9px;
    }
    .node-preview-container {
        position: initial;
    }
</style>

                                </html>";
    }

    public function getTemplateName()
    {
        return "themes/custom/basic/templates/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  230 => 72,  222 => 69,  219 => 68,  217 => 67,  213 => 66,  210 => 65,  208 => 64,  185 => 54,  175 => 51,  168 => 46,  166 => 45,  157 => 39,  150 => 35,  148 => 34,  131 => 32,  127 => 31,  123 => 30,  119 => 29,  112 => 25,  105 => 21,  101 => 20,  97 => 19,  93 => 18,  89 => 16,  83 => 14,  77 => 11,  72 => 9,  68 => 8,  63 => 7,  55 => 6,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/basic/templates/html.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/themes/custom/basic/templates/html.html.twig");
    }
}
