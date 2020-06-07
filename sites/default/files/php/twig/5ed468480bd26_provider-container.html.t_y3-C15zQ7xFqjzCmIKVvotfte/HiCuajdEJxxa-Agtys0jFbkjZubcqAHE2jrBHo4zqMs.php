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

/* modules/contrib/social_login/templates/provider-container.html.twig */
class __TwigTemplate_685391e0f1deb7b68b262d389e6686936fae9d715f0d47d57ae47c74ff4bdb79 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 7];
        $filters = ["length" => 7, "escape" => 9, "raw" => 15, "join" => 15];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['length', 'escape', 'raw', 'join'],
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
        // line 7
        if ((twig_length_filter($this->env, ($context["providers"] ?? null)) > 0)) {
            // line 8
            echo "<div class=\"social_login\" style=\"margin:20px 0 10px 0\">
 ";
            // line 9
            if ( !twig_test_empty(($context["label"] ?? null))) {
                echo "<label>";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
                echo "</label>";
            }
            // line 10
            echo " <div id=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["containerid"] ?? null)), "html", null, true);
            echo "\"></div>
</div>

<script type=\"text/javascript\">
\tvar _oneall = _oneall || [];
\t_oneall.push([\"";
            // line 15
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["plugintype"] ?? null)), "html", null, true);
            echo "\", \"set_providers\", ['";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(twig_join_filter($this->sandbox->ensureToStringAllowed(($context["providers"] ?? null)), "','"));
            echo "']]);
\t_oneall.push([\"";
            // line 16
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["plugintype"] ?? null)), "html", null, true);
            echo "\", \"set_callback_uri\", \"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["callbackuri"] ?? null)), "html", null, true);
            echo "\"]);
\t_oneall.push([\"";
            // line 17
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["plugintype"] ?? null)), "html", null, true);
            echo "\", \"set_force_re_authentication\", ";
            if ((($context["plugintype"] ?? null) == "social_link")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "]);
\t";
            // line 18
            if ( !twig_test_empty(($context["token"] ?? null))) {
                // line 19
                echo "\t_oneall.push([\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["plugintype"] ?? null)), "html", null, true);
                echo "\", \"set_user_token\", \"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["token"] ?? null)), "html", null, true);
                echo "\"]);
\t";
            }
            // line 21
            echo "\t_oneall.push([\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["plugintype"] ?? null)), "html", null, true);
            echo "\", \"do_render_ui\", \"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["containerid"] ?? null)), "html", null, true);
            echo "\"]);
</script>
";
        } else {
            // line 24
            echo "<div class=\"messages messages--error\">
    <div role=\"alert\">
        Please enable at least one social network in the social login settings.
    </div>
</div>      
";
        }
    }

    public function getTemplateName()
    {
        return "modules/contrib/social_login/templates/provider-container.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 24,  107 => 21,  99 => 19,  97 => 18,  87 => 17,  81 => 16,  75 => 15,  66 => 10,  60 => 9,  57 => 8,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/social_login/templates/provider-container.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/modules/contrib/social_login/templates/provider-container.html.twig");
    }
}
