package com.trixx1.stretchres.client.gui;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.gui.DrawContext;
import net.minecraft.client.gui.screen.Screen;
import net.minecraft.client.gui.widget.ButtonWidget;
import net.minecraft.client.gui.widget.SliderWidget;
import net.minecraft.text.Text;

public class StretchScreen extends Screen {
    public StretchScreen() {
        super(Text.literal("Stretch Resolution Settings"));
    }

    @Override
    protected void init() {
        this.addDrawableChild(new SliderWidget(this.width / 2 - 100, this.height / 2 - 20, 200, 20, Text.literal("Stretch Factor: " + String.format("%.2f", StretchConfig.stretchFactor)), (StretchConfig.stretchFactor - 0.5) / 1.5) {
            @Override
            protected void updateMessage() {
                this.setMessage(Text.literal("Stretch Factor: " + String.format("%.2f", StretchConfig.stretchFactor)));
            }

            @Override
            protected void applyValue() {
                StretchConfig.stretchFactor = 0.5 + this.value * 1.5;
            }
        });

        this.addDrawableChild(ButtonWidget.builder(Text.literal("Reset"), button -> {
            StretchConfig.stretchFactor = 1.0;
            this.clearAndInit();
        }).dimensions(this.width / 2 - 100, this.height / 2 + 10, 200, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("Done"), button -> {
            this.close();
        }).dimensions(this.width / 2 - 100, this.height / 2 + 40, 200, 20).build());
    }

    @Override
    public void render(DrawContext context, int mouseX, int mouseY, float delta) {
        super.render(context, mouseX, mouseY, delta);
        context.drawCenteredTextWithShadow(this.textRenderer, this.title, this.width / 2, 20, 0xFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("Made by trixx1_"), this.width / 2, this.height - 30, 0xFFA500);
    }
}
