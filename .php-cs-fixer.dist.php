<?php

$finder = (new PhpCsFixer\Finder())
    ->in(sprintf('%s/src', __DIR__))
    ->in(sprintf('%s/tests', __DIR__));

return (new PhpCsFixer\Config())
    ->setCacheFile(__DIR__ . '/var/cache/.php-cs-fixer.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'align_multiline_comment' => ['comment_type' => 'all_multiline'],
        'binary_operator_spaces' => ['operators' => ['|' => 'no_space']],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'final_internal_class' => [
            'annotation_exclude' => ['@entity'],
            'consider_absent_docblock_as_internal_class' => true,
        ],
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => false,
            'import_functions' => false,
        ],
        'mb_str_functions' => true,
        'modernize_types_casting' => true,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'native_function_invocation' => ['include' => [], 'strict' => true],
        'no_break_comment' => false,
        'no_extra_blank_lines' => false,
        'no_trailing_whitespace_in_string' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_useless_sprintf' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_line_span' => ['property' => 'single', 'method' => 'single'],
        'phpdoc_order' => true,
        'phpdoc_separation' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'return_assignment' => true,
        'simplified_if_return' => true,
        'single_line_throw' => false,
        'strict_comparison' => true,
        'strict_param' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters']],
        'use_arrow_functions' => true,
        'void_return' => true,
        'yoda_style' => ['identical' => true],
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'php_unit_test_annotation' => ['style' => 'prefix'],
    ])
    ->setFinder($finder);
