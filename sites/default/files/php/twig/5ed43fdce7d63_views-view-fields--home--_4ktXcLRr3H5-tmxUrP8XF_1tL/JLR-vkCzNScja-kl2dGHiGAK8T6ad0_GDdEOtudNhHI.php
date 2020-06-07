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

/* themes/custom/basic/templates/views/home/views-view-fields--home--block-5.html.twig */
class __TwigTemplate_240daa19f03a2a9af208241c41acbd4d7e9579574780c6762a905447b030ab2d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 7, "if" => 7];
        $filters = ["escape" => 4];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                []
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
        echo "<div class=\"item-news more-shared home\">
    <div class=\"picture\">
        <div class=\"count\">1</div>
        <figure>";
        // line 4
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_image", []), "content", [])), "html", null, true);
        echo "</figure>
    </div>
    <div class=\"text\">
        <div ";
        // line 7
        $context["nid"] = $this->getAttribute($this->getAttribute($this->getAttribute(($context["row"] ?? null), "_entity", []), "nid", []), "value", []);
        echo " class=\"save ";
        if (twig_in_filter(($context["nid"] ?? null), $this->getAttribute($this->getAttribute(($context["user"] ?? null), "node_saved", []), "split", [], "array"))) {
            echo "saved";
        } else {
            echo "no";
        }
        echo "\" data-id=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["nid"] ?? null)), "html", null, true);
        echo "\" data-session=\"";
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo "authentificate";
        } else {
            echo "anonime";
        }
        echo "\">
            <a href=\"#\" class=\"node_saved\">Guardar</a>
        </div>
        <span class=\"category\">";
        // line 10
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "field_categoria", []), "content", [])), "html", null, true);
        echo "</span>
        <h3 class=\"title\">";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "title", []), "content", [])), "html", null, true);
        echo "</h3>
        <p class=\"sumary\">";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "body", []), "content", [])), "html", null, true);
        echo "</p>
        <div class=\"info\">
            <span class=\"cont\"> <i class=\"reader\"></i> 1234 Shared</span>
            <date>";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "created", []), "content", [])), "html", null, true);
        echo "</date>
        </div>
        <div class=\"explorer\">";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["fields"] ?? null), "nothing_1", []), "content", [])), "html", null, true);
        echo "</div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "themes/custom/basic/templates/views/home/views-view-fields--home--block-5.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 17,  100 => 15,  94 => 12,  90 => 11,  86 => 10,  66 => 7,  60 => 4,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/basic/templates/views/home/views-view-fields--home--block-5.html.twig", "/Volumes/HD-Project-Macbook/Web/Desarrollos Web/proyectos/global-rheumatology/themes/custom/basic/templates/views/home/views-view-fields--home--block-5.html.twig");
    }
}
