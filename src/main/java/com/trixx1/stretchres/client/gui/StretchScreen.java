package com.trixx1.stretchres.client.gui;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.gui.DrawContext;
import net.minecraft.client.gui.screen.Screen;
import net.minecraft.client.render.RenderLayer;
import net.minecraft.client.gui.widget.ButtonWidget;
import net.minecraft.client.gui.widget.SliderWidget;
import net.minecraft.client.gui.widget.TextFieldWidget;
import net.minecraft.text.Text;
import net.minecraft.util.Identifier;
import net.minecraft.util.math.MathHelper;

public class StretchScreen extends Screen {
    private static final Identifier HENTAI_1 = Identifier.of("stretchres", "textures/gui/hentai1.png");
    private static final Identifier HENTAI_2 = Identifier.of("stretchres", "textures/gui/hentai2.png");

    private TextFieldWidget profileNameField;
    private float time = 0;
    private int currentTab = 0; // 0: Stretch/Swing, 1: Viewmodel, 2: Profiles

    public StretchScreen() {
        super(Text.literal("StretchRes Ultimate"));
    }

    @Override
    protected void init() {
        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // --- TABS ---
        this.addDrawableChild(ButtonWidget.builder(Text.literal(currentTab == 0 ? "§lPvP" : "PvP"), b -> { currentTab = 0; this.init(this.client, this.width, this.height); }).dimensions(centerX - 100, 15, 60, 20).build());
        this.addDrawableChild(ButtonWidget.builder(Text.literal(currentTab == 1 ? "§lVisual" : "Visual"), b -> { currentTab = 1; this.init(this.client, this.width, this.height); }).dimensions(centerX - 30, 15, 60, 20).build());
        this.addDrawableChild(ButtonWidget.builder(Text.literal(currentTab == 2 ? "§lConfig" : "Config"), b -> { currentTab = 2; this.init(this.client, this.width, this.height); }).dimensions(centerX + 40, 15, 60, 20).build());

        if (currentTab == 0) {
            // --- PVP TAB ---
            this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 80, 200, 20, Text.literal("Stretch Factor"), (StretchConfig.currentProfile.stretchFactor - 0.1) / 9.9) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§6§lSTRETCH: §f" + String.format("%.2f", StretchConfig.currentProfile.stretchFactor))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.stretchFactor = 0.1 + this.value * 9.9; }
            });

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")), button -> {
                StretchConfig.currentProfile.noHandSwing = !StretchConfig.currentProfile.noHandSwing;
                button.setMessage(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")));
            }).dimensions(centerX - 100, centerY - 55, 95, 20).build());

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§bStyle: " + (StretchConfig.currentProfile.oldSwing ? "§e1.8" : "§fModern")), button -> {
                StretchConfig.currentProfile.oldSwing = !StretchConfig.currentProfile.oldSwing;
                button.setMessage(Text.literal("§bStyle: " + (StretchConfig.currentProfile.oldSwing ? "§e1.8" : "§fModern")));
            }).dimensions(centerX + 5, centerY - 55, 95, 20).build());

            this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 30, 95, 20, Text.literal("Speed"), StretchConfig.currentProfile.swingSpeed / 5.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§bSpd: §f" + String.format("%.1f", StretchConfig.currentProfile.swingSpeed))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.swingSpeed = this.value * 5.0; }
            });

            this.addDrawableChild(new SliderWidget(centerX + 5, centerY - 30, 95, 20, Text.literal("Smooth"), (StretchConfig.currentProfile.swingSmoothness - 0.1) / 4.9) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§3Smth: §f" + String.format("%.1f", StretchConfig.currentProfile.swingSmoothness))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.swingSmoothness = 0.1 + this.value * 4.9; }
            });

            // Swing Angles
            this.addDrawableChild(new SliderWidget(centerX - 100, centerY + 0, 60, 20, Text.literal("AX"), (StretchConfig.currentProfile.swingAngleX + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§eAX: §f" + (int)StretchConfig.currentProfile.swingAngleX)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.swingAngleX = -180.0 + this.value * 360.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX - 30, centerY + 0, 60, 20, Text.literal("AY"), (StretchConfig.currentProfile.swingAngleY + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§eAY: §f" + (int)StretchConfig.currentProfile.swingAngleY)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.swingAngleY = -180.0 + this.value * 360.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX + 40, centerY + 0, 60, 20, Text.literal("AZ"), (StretchConfig.currentProfile.swingAngleZ + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§eAZ: §f" + (int)StretchConfig.currentProfile.swingAngleZ)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.swingAngleZ = -180.0 + this.value * 360.0; }
            });

        } else if (currentTab == 1) {
            // --- VISUAL TAB ---
            this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 80, 60, 20, Text.literal("X"), (StretchConfig.currentProfile.viewmodelX + 2) / 4.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§aX: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelX))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelX = -2.0 + this.value * 4.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX - 30, centerY - 80, 60, 20, Text.literal("Y"), (StretchConfig.currentProfile.viewmodelY + 2) / 4.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§aY: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelY))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelY = -2.0 + this.value * 4.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX + 40, centerY - 80, 60, 20, Text.literal("Z"), (StretchConfig.currentProfile.viewmodelZ + 2) / 4.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§aZ: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelZ))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelZ = -2.0 + this.value * 4.0; }
            });

            this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 55, 60, 20, Text.literal("Pitch"), (StretchConfig.currentProfile.viewmodelPitch + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§dP: §f" + (int)StretchConfig.currentProfile.viewmodelPitch)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelPitch = -180.0 + this.value * 360.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX - 30, centerY - 55, 60, 20, Text.literal("Yaw"), (StretchConfig.currentProfile.viewmodelYaw + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§dY: §f" + (int)StretchConfig.currentProfile.viewmodelYaw)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelYaw = -180.0 + this.value * 360.0; }
            });
            this.addDrawableChild(new SliderWidget(centerX + 40, centerY - 55, 60, 20, Text.literal("Roll"), (StretchConfig.currentProfile.viewmodelRoll + 180) / 360.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§dR: §f" + (int)StretchConfig.currentProfile.viewmodelRoll)); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelRoll = -180.0 + this.value * 360.0; }
            });

            this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 30, 200, 20, Text.literal("Scale"), StretchConfig.currentProfile.viewmodelScale / 2.0) {
                @Override protected void updateMessage() { this.setMessage(Text.literal("§3Scale: §f" + String.format("%.2f", StretchConfig.currentProfile.viewmodelScale))); }
                @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelScale = this.value * 2.0; }
            });

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§5Hide Hand: " + (StretchConfig.currentProfile.hideHand ? "§aON" : "§cOFF")), button -> {
                StretchConfig.currentProfile.hideHand = !StretchConfig.currentProfile.hideHand;
                button.setMessage(Text.literal("§5Hide Hand: " + (StretchConfig.currentProfile.hideHand ? "§aON" : "§cOFF")));
            }).dimensions(centerX - 100, centerY - 5, 200, 20).build());

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§bRGB Borders: " + (StretchConfig.currentProfile.rgbBorders ? "§aON" : "§cOFF")), button -> {
                StretchConfig.currentProfile.rgbBorders = !StretchConfig.currentProfile.rgbBorders;
                button.setMessage(Text.literal("§bRGB Borders: " + (StretchConfig.currentProfile.rgbBorders ? "§aON" : "§cOFF")));
            }).dimensions(centerX - 100, centerY + 20, 200, 20).build());

        } else {
            // --- CONFIG TAB ---
            this.profileNameField = new TextFieldWidget(this.textRenderer, centerX - 100, centerY - 40, 140, 20, Text.literal("Profile Name"));
            this.profileNameField.setText(StretchConfig.currentProfileName);
            this.addDrawableChild(this.profileNameField);

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§a§lSAVE"), button -> {
                StretchConfig.saveProfile(this.profileNameField.getText());
            }).dimensions(centerX + 45, centerY - 40, 55, 20).build());

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§e§lLOAD"), button -> {
                StretchConfig.loadProfile(this.profileNameField.getText());
                this.init(this.client, this.width, this.height);
            }).dimensions(centerX - 100, centerY - 15, 95, 20).build());

            this.addDrawableChild(ButtonWidget.builder(Text.literal("§c§lRESET"), button -> {
                StretchConfig.currentProfile = new StretchConfig.Profile();
                this.init(this.client, this.width, this.height);
            }).dimensions(centerX + 5, centerY - 15, 95, 20).build());
        }

        // --- BOTTOM ---
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§f§lDONE"), button -> {
            StretchConfig.saveProfile(StretchConfig.currentProfileName);
            this.close();
        }).dimensions(centerX - 100, this.height - 40, 200, 20).build());
    }

    @Override
    public void render(DrawContext context, int mouseX, int mouseY, float delta) {
        this.time += delta;
        this.renderBackground(context, mouseX, mouseY, delta);

        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // Animated RGB Border
        int borderColor = 0xFFAA00FF;
        if (StretchConfig.currentProfile.rgbBorders) {
            float cycle = (time * 0.04F);
            int r = (int)((MathHelper.sin(cycle) + 1.0F) * 127);
            int g = (int)((MathHelper.sin(cycle + 2.0F) + 1.0F) * 127);
            int b = (int)((MathHelper.sin(cycle + 4.0F) + 1.0F) * 127);
            borderColor = 0xFF000000 | r << 16 | g << 8 | b;
        }

        context.fillGradient(0, 0, this.width, this.height, 0x99000000 | (borderColor & 0x00FFFFFF), 0x00000000);

        int pw = 140;
        context.fillGradient(centerX - pw, 40, centerX + pw, this.height - 45, 0xF5050505, 0xF5111111);

        context.fill(centerX - pw, 40, centerX - pw + 1, this.height - 45, borderColor);
        context.fill(centerX + pw - 1, 40, centerX + pw, this.height - 45, borderColor);

        // Pictures
        try {
            int iw = 180, ih = 280;
            context.fill(1, centerY - (ih/2) - 2, iw + 7, centerY + (ih/2) + 2, borderColor);
            context.drawTexture(RenderLayer::getGuiTextured, HENTAI_1, 5, centerY - (ih/2), 0, 0, iw, ih, iw, ih);

            context.fill(this.width - iw - 7, centerY - (ih/2) - 2, this.width - 1, centerY + (ih/2) + 2, borderColor);
            context.drawTexture(RenderLayer::getGuiTextured, HENTAI_2, this.width - iw - 5, centerY - (ih/2), 0, 0, iw, ih, iw, ih);
        } catch (Exception e) {}

        super.render(context, mouseX, mouseY, delta);

        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§l§bSTRETCHRES §f§lULTIMATE"), centerX, 45, 0xFFFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§d§lMade by trixx1_"), centerX, this.height - 18, 0xFFFFFFFF);
    }
}
