package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.render.item.HeldItemRenderer;
import net.minecraft.client.util.math.MatrixStack;
import net.minecraft.util.Arm;
import net.minecraft.util.Hand;
import net.minecraft.util.math.RotationAxis;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.ModifyVariable;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfo;
import org.joml.Quaternionf;
import net.minecraft.util.math.MathHelper;
import net.minecraft.client.network.AbstractClientPlayerEntity;
import net.minecraft.client.render.VertexConsumerProvider;
import net.minecraft.item.ItemStack;

@Mixin(HeldItemRenderer.class)
public class HeldItemRendererMixin {

    @Inject(method = "renderFirstPersonItem", at = @At("HEAD"), cancellable = true)
    private void onRenderFirstPersonItem(AbstractClientPlayerEntity player, float tickDelta, float pitch, Hand hand, float swingProgress, ItemStack item, float equipProgress, MatrixStack matrices, VertexConsumerProvider vertexConsumers, int light, CallbackInfo ci) {
        if (StretchConfig.currentProfile.hideHand) {
            ci.cancel();
        }
    }

    @Inject(method = "applySwingOffset", at = @At("HEAD"), cancellable = true)
    private void onApplySwingOffset(MatrixStack matrices, Arm arm, float swingProgress, CallbackInfo ci) {
        if (StretchConfig.currentProfile.noHandSwing) {
            ci.cancel();
            return;
        }

        float speedProgress = (float) MathHelper.clamp(swingProgress * StretchConfig.currentProfile.swingSpeed, 0.0, 1.0);
        float s = (float) StretchConfig.currentProfile.swingSmoothness;
        float smoothProgress = (float) (s > 1.0 ? 1.0 - Math.pow(1.0 - speedProgress, s) : Math.pow(speedProgress, 1.0/s));

        if (StretchConfig.currentProfile.oldSwing) {
            float f = MathHelper.sin(smoothProgress * (float)Math.PI);
            float f1 = MathHelper.sin(MathHelper.sqrt(smoothProgress) * (float)Math.PI);

            // Precise 1.8 Swing Reconstruction
            float side = (arm == Arm.RIGHT ? 1 : -1);
            matrices.translate(-side * 0.4F * f1, 0.2F * MathHelper.sin(MathHelper.sqrt(smoothProgress) * (float)Math.PI * 2.0F), -0.2F * f);

            float f2 = MathHelper.sin(smoothProgress * smoothProgress * (float)Math.PI);
            float f3 = MathHelper.sin(MathHelper.sqrt(smoothProgress) * (float)Math.PI);
            matrices.multiply(RotationAxis.POSITIVE_Y.rotationDegrees(side * (45.0F + f2 * -20.0F)));
            matrices.multiply(RotationAxis.POSITIVE_Z.rotationDegrees(side * f3 * -20.0F));
            matrices.multiply(RotationAxis.POSITIVE_X.rotationDegrees(f3 * -80.0F));
            matrices.multiply(RotationAxis.POSITIVE_Y.rotationDegrees(side * -45.0F));

            ci.cancel();
        }
    }

    @ModifyVariable(method = "applySwingOffset", at = @At("HEAD"), ordinal = 0, argsOnly = true)
    private float modifySwingProgress(float swingProgress) {
        float speedProgress = (float) MathHelper.clamp(swingProgress * StretchConfig.currentProfile.swingSpeed, 0.0, 1.0);
        float s = (float) StretchConfig.currentProfile.swingSmoothness;
        return (float) (s > 1.0 ? 1.0 - Math.pow(1.0 - speedProgress, s) : Math.pow(speedProgress, 1.0/s));
    }

    @Inject(method = "applyEquipOffset", at = @At("HEAD"))
    private void onApplyEquipOffset(MatrixStack matrices, Arm arm, float equipProgress, CallbackInfo ci) {
        float x = (float) StretchConfig.currentProfile.viewmodelX;
        float y = (float) StretchConfig.currentProfile.viewmodelY;
        float z = (float) StretchConfig.currentProfile.viewmodelZ;
        float s = (float) StretchConfig.currentProfile.viewmodelScale;

        float pitch = (float) StretchConfig.currentProfile.viewmodelPitch;
        float yaw = (float) StretchConfig.currentProfile.viewmodelYaw;
        float roll = (float) StretchConfig.currentProfile.viewmodelRoll;

        if (arm == Arm.LEFT) {
            matrices.translate(-x, y, z);
            matrices.multiply(new Quaternionf().rotationXYZ(
                (float)Math.toRadians(pitch),
                (float)Math.toRadians(-yaw),
                (float)Math.toRadians(-roll)));
        } else {
            matrices.translate(x, y, z);
            matrices.multiply(new Quaternionf().rotationXYZ(
                (float)Math.toRadians(pitch),
                (float)Math.toRadians(yaw),
                (float)Math.toRadians(roll)));
        }

        matrices.scale(s, s, s);
    }
}
