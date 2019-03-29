{extends file='frontend/account/index.tpl'}

{* Breadcrumb *}
{block name='frontend_index_start'}
    {$smarty.block.parent}
    {$sBreadcrumb[] = ['name' => "{s name='MyCartsTitle'}Meine Warenkörbe{/s}", 'link' => {url}]}
{/block}

{block name="frontend_index_content"}
    <div class="content account--content">
        {* Welcome text *}
        {block name="frontend_account_carts_welcome"}
            <div class="account--welcome panel">
                {block name="frontend_account_carts_welcome_headline"}
                    <h1 class="panel--title">{s name="MyCarts"}Meine Warenkörbe{/s}</h1>
                {/block}

                {block name="frontend_account_carts_welcome_content"}
                    <div class="panel--body is--wide">
                        <p>{s name="MyCartsWelcomeText"}Hier finden Sie eine Übersicht über Ihre gespeicherten Warenkörbe.{/s}</p>
                    </div>
                {/block}
            </div>
        {/block}


        {if !$froshSavedCarts}
            {block name="frontend_account_carts_info_empty"}
                <div class="account--no-carts-info">
                    {include file="frontend/_includes/messages.tpl" type="warning" content="{s name='CartsInfoEmpty'}Keine gespeicherten Warenkörbe vorhanden.{/s}"}
                </div>
            {/block}
        {else}
            {block name="frontend_account_carts_list"}
                {foreach $froshSavedCarts as $cart}
                    {$cart->getId()}
                {/foreach}
            {/block}
        {/if}
    </div>
{/block}
